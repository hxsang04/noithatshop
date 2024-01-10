<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Slider;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('slider_status',1)->get();
        $products_here = Product::where('product_status',1)->inRandomOrder()->take(4)->get();
        $products_next = Product::where('product_status',1)->inRandomOrder()->skip(4)->take(4)->get();
        $product_sellers = Product::where([['product_status',1],['product_sold','>',0]])->orderby('product_sold','desc')->get();
        return view('User.index', compact('sliders','products_here','products_next','product_sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $cart = Cart::where([['user_id',Auth::id()],['product_id',request()->id],['cart_status',1]])->first();
            if($cart){
                $cart->cart_qty = request()->qty + $cart->cart_qty;
                $cart->save();
            }else{
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = request()->id;
                $cart->cart_qty = request()->qty;
                $cart->cart_status = 1;
                $cart->save();
            }
            return response()->json([
                'action' => 'add',
                'message' => 'Add To Cart Successfully'
            ]);
        }else{
            return response()->json([
                'action' => 'login',
                'url' => route('sign.index')
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $carts = Cart::join('products','carts.product_id','products.product_id')->where([['cart_status',1],['user_id',Auth::id()]])->get();

            return response()->json([
                'count'=>count($carts)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Product::where('product_slug',$id)->orwhere('product_id',$id)->first();
        if($result)
        {
            return $this->showPro($result);
        }

        $result = Category::where('category_slug',$id)->orwhere('category_id',$id)->first();
        if($result)
        {
            return $this->showCate($result);
        }

        abort('404');
    }

    public function showCate($result){
        $title = 'Shop '. ucfirst($result->category_name);
        $products = Product::where([['product_status',1],['category_id',$result->category_id]])->orderby('product_id','desc')->paginate(6);
        $categories = Category::all();
        return view('User.allproduct', [ 'category' =>$result, 'title' => $title, 'categories' =>$categories, 'products' =>$products ]);
    }

    public function showPro($result){
        $product_sellers = Product::where([['product_status',1],['category_id',$result->category_id]])->inRandomOrder()->get();

        Product::find($result->product_id)->update([
            'product_view' => $result->product_view + 1
        ]);

        return view('User.detail_product', [
            'product' =>$result,
            'product_sellers' => $product_sellers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
