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
                            <h2>Producta Checkout</h2>
                            <p>Home <span>-</span> Shop Single</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <form class="row contact_form" action="{{ route('cart.store') }}" method="post">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" placeholder="Full name" required class="form-control" id="name"
                                    name="name" value="{{ Auth::check() ? ucfirst(Auth::user()->name) : '' }}" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="email" placeholder="Email Address" required class="form-control"
                                    id="email" name="email"
                                    value="{{ Auth::check() ? Auth::user()->email : '' }}" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="tel" pattern="[0-9]{10}" placeholder="Phone number" required
                                    class="form-control" id="phone" name="phone" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" placeholder="Address" required class="form-control" id="address"
                                    name="address" />
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                </div>
                                <textarea class="form-control" name="note" id="note" rows="10" style="height: 134px;"
                                    placeholder="Order Notes"></textarea>
                            </div>


                        </div>
                        @php
                            $total = 0;
                        @endphp
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    @foreach ($carts as $cart)
                                        @php
                                            $total += $cart->product_price * $cart->cart_qty;
                                        @endphp
                                        <li>
                                            <a href="#">{{ ucfirst($cart->product_name) }}
                                                <span class="middle">x {{ $cart->cart_qty }}</span>
                                                <span
                                                    class="last">{{ number_format($cart->cart_qty * $cart->product_price) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                            <span>{{ number_format($total) }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Shipping
                                            <span>Flat rate: 0</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Total
                                            <span>{{ number_format($total) }}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" checked id="f-option5" name="change_pay" value="COD" />
                                        <label for="f-option5">Cash on delivery</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Please send a check to Store Name, Store Street, Store Town
                                    </p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="change_pay" value="ATM" />
                                        <label for="f-option6">Vnpay </label>
                                        <img style="width: 21%" src="{{ asset('frontend/img/product/single-product/cart2.png') }}"
                                            alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Please send a check to Store Name, Store Street, Store Town
                                    </p>
                                </div>
                                <div class="creat_account">

                                </div>
                                <button type="submit" class="btn_3 col-12">Proceed to Paypal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================End Checkout Area =================-->
@endsection

