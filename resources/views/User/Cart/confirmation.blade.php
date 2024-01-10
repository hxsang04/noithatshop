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
                            <h2>Order Confirmation</h2>
                            <p>Home <span>-</span> Order Confirmation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================ confirmation part start =================-->
    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="confirmation_tittle">
                        <span>Thank you. Your order has been received.</span><p></p>
                        <a href="{{ route('home.index') }}" class="btn_3 mt-4">Go Home</a>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>order info</h4>
                        <ul>
                            <li>
                                <p>order number</p><span>: {{ $orderd->order_code }}</span>
                            </li>
                            <li>
                                <p>data</p><span>: {{ Carbon\Carbon::parse($orderd->created_at)->toFormattedDateString() }}</span>
                            </li>
                            <li>
                                <p>total</p> <span id="total"></span>
                            </li>
                            <li>
                                <p>mayment methord</p><span>: {{ $customer->customer_pay == 'COD' ? 'Cash on delivery' : 'Vnpay' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Billing Address</h4>
                        <ul>
                            <li>
                                <p>Street</p><span>: {{ $customer->customer_address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>shipping Address</h4>
                        <ul>
                            <li>
                                <p>Street</p><span>: {{ $customer->customer_address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <h3>Order Details</h3>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($orders as $order)
                                @php
                                    $total += $order->order_detail_qty * $order->product_price;
                                @endphp
                                <tr>
                                    <th colspan="2"><span>{{ ucfirst($order->product_name) }}</span></th>
                                    <th>x{{ $order->order_detail_qty }}</th>
                                    <th> <span>{{ number_format($order->order_detail_qty * $order->product_price) }}</span></th>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3">Subtotal</th>
                                    <th> <span>{{ number_format($total) }}</span></th>
                                </tr>
                                <tr>
                                    <th colspan="3">shipping</th>
                                    <th><span>flat rate: 0</span></th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" colspan="3">Total</th>
                                    <th scope="col" id="cast_total">{{ number_format($total) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ confirmation part end =================-->
@endsection
@section('js')
    <script>
        $('#total').text(': '+$('#cast_total').text());
    </script>
@stop
