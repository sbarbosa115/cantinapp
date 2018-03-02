@extends('frontend.base')

@section('body_class', '')

@section('content')
    <div class="page-container" id="PageContainer">
        <main class="main-content" id="MainContent" role="main">
            <section class="heading-content">
                <div class="heading-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="page-heading-inner heading-group">
                                <div class="breadcrumb-group">
                                    <h1 class="hidden">Create Order</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="order-layout">
                <div class="order-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="order-inner">
                                <div class="order-content">
                                    <div class="order-id">
                                        <h2>Order #1002</h2>
                                        <span class="date">{{\Carbon\Carbon::now()->format('l jS F Y')  }}</span>
                                    </div>

                                    @if(Auth::user())
                                        <div class="order-address">
                                            <div id="order_payment" class="col-md-6 address-items">
                                                <h2 class="address-title">Billing Address</h2>
                                                <div class="address-content">
                                                    <div class="address-item">
                                                        <span class="title">Payment Status:</span>
                                                        <span class="content">Pick Up Payment</span>
                                                    </div>
                                                    <div class="address-item name">
                                                        <span class="title">Your name:</span>
                                                        <span class="content">{{ Auth::user()->name }}</span>
                                                    </div>
                                                    <div class="address-item">
                                                        <span class="title">Your email:</span>
                                                        <span class="content">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else

                                    @endif

                                    <div class="order-info">
                                        <div class="order-info-inner">
                                            <table id="order_details">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th class="center">Quantity</th>
                                                        <th class="total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(Session::has('order'))
                                                        @foreach(Session::get('order') as $product)
                                                            <tr id="10324769618" class="odd">
                                                                <td class="td-product">
                                                                    <a href="./product.html" title="">{{$product->name}}</a>
                                                                </td>
                                                                <td class="money"><span class="money">{{ $product->getCurrency() }}</span></td>
                                                                <td class="quantity ">{{ $product->quantity }}</td>
                                                                <td class="total"><span class="money">$ {{ $product->getTotalProductOrder() }}</span></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    @if(Session::has('order'))
                                                        <tr class="order_summary note">
                                                            <td class="td-label" colspan="3">Subtotal</td>
                                                            <td class="subtotal"><span class="money">{{ $orderDetail['total'] }}</span></td>
                                                        </tr>
                                                        @if(config('customer.tax'))
                                                            <tr class="order_summary note">
                                                                <td class="td-label" colspan="3">Tax {{ config('customer.tax') }}%:</td>
                                                                <td class="vat"><span class="money">$ {{ $orderDetail['tax'] }}</span></td>
                                                            </tr>
                                                        @endif
                                                        <tr class="order_summary order_total">
                                                            <td class="td-label" colspan="3">Total</td>
                                                            <td class="total"><span class="money">$ {{ $orderDetail['total'] + $orderDetail['tax'] }}</span></td>
                                                        </tr>
                                                    @endif
                                                </tfoot>
                                            </table>
                                            <br />
                                            <buttom class="btn btn-success col-md-12" id="proceed-to-order">Proceed to Order</buttom>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).off("click", "#proceed-to-order").on("click", "#proceed-to-order", function (e) {
            e.preventDefault();

            $.get("{{ route('frontend.order.confirm') }}", function (data) {
                $("#modal-messages").html(data).modal();
            });
        });
    </script>
@endsection