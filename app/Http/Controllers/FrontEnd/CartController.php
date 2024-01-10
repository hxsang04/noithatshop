<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Order;
use App\Customer;
use Carbon\Carbon;
use App\OrderDetail;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->code = date('YmdHis');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cart->getCart();
        return view('User.Cart.shopping_cart', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = $this->cart->getCart();
        return view('User.Cart.checkout', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_order[] = array(
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'customer_pay' => $request->change_pay,
            'customer_note' => $request->note,
        );
        Session::put('customer_order',$customer_order);

        if($request->change_pay == 'ATM'){
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_TmnCode = "HHP1RX2O"; //Mã website tại VNPAY
            $vnp_HashSecret = "IIVOHTNIMSVQZTAUSANLVVBPRDRHNEPS"; //Chuỗi bí mật
            $vnp_Returnurl = "".route('vnpay.return')."";

            $total = 0;
            foreach($this->cart->getCart() as $cart){
                $total += $cart->cart_qty * $cart->product_price;
            }

            $vnp_TxnRef = $this->code;
            $vnp_OrderInfo = "Thanh Toán";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $total * 100;
            $vnp_Locale = config('app.locale');
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return redirect($vnp_Url);
        }else{
            return $this->SaveOrder();
        }
    }

    public function VnpayReturn(){
        return $this->SaveOrder();
    }

    public function SaveOrder(){
        try{
            DB::beginTransaction();
            foreach(Session::get('customer_order') as $customer){
                $customer  = Customer::insertGetId([
                    'customer_name' => $customer['customer_name'],
                    'customer_email' => $customer['customer_email'],
                    'customer_phone' => $customer['customer_phone'],
                    'customer_address' => $customer['customer_address'],
                    'customer_pay' => $customer['customer_pay'],
                    'customer_note' => $customer['customer_note'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
            Order::create([
                'customer_id' => $customer,
                'order_code' => $this->code,
                'order_status' => 1,
            ]);
            foreach($this->cart->getCart() as $cart){
                OrderDetail::create([
                    'order_code' => $this->code,
                    'product_id' => $cart->product_id,
                    'order_detail_qty' => $cart->cart_qty,
                    'order_detail_price' => $cart->product_price
                ]);

                Cart::where('cart_id',$cart->cart_id)->update(['cart_status' => 2]);
            }
            DB::commit();

            return redirect()->route('cart.info',$this->code);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function Confrimation($id){
        $orders = OrderDetail::join('products','products.product_id','order_details.product_id')->where('order_code',$id)->get();

        $orderd = Order::where('order_code',$id)->first();
        $customer = Customer::find($orderd->customer_id);


        return view('User.Cart.confirmation', compact('orders','customer','orderd'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::find($id);
        $cart->cart_qty = request()->qty;
        $cart->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
