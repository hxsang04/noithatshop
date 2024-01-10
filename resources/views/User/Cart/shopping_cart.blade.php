@extends('Layout_user')
@section('content')
    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Cart Products</h2>
                            <p>Home <span>-</span>Cart Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Cart Area =================-->
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                            @php
                                $total += $cart->product_price * $cart->cart_qty;
                            @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('uploads/product/' . $cart->product_image) }}"
                                                    style="width: 20%;" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ ucfirst($cart->product_name) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ number_format($cart->product_price) }}</h5>
                                    </td>
                                    <td>
                                        <input style="border: 1px solid;text-align: center;border-radius: 38px;" class="upqty" id="{{ $cart->cart_id }}" type="number" value="{{ $cart->cart_qty }}" min="1" max="{{ $cart->product_qty }}">
                                    </td>
                                    <td>
                                        <h5>{{ number_format($cart->product_price * $cart->cart_qty) }}</h5>
                                    </td>
                                    <td></td>
                                    <td><a style="color: #ff3368" href="{{ route('cart.edit',$cart->cart_id ) }}" class="delcart" id="">X</td>
                                </tr>
                            @endforeach
                            <tr class="bottom_button">
                                <td>
                                    <a class="btn_1" href="#">Delete Cart</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="subtotal">{{ number_format($total) }} vnđ</h5>
                                </td>
                                <td></td>
                            </tr>
                            <tr class="shipping_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>0 vnđ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5 id="total">{{ number_format($total) }} vnđ</h5>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="{{ route('home.index') }}">Continue Shopping</a>
                        <a class="btn_1 checkout_btn_1" href="{{ route('cart.create') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('js')
    <script>
        $(document).on('change','.upqty',function(){
            var id = $(this).attr('id');
            var qty = $(this).val();

            $.ajax({
                type:'get',
                url:'cart/'+id,
                data: { qty:qty },
                success:function(res){
                    location.reload();
                }
            })
        });
    </script>
@stop
