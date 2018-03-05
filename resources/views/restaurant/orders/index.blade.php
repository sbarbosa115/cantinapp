@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">

            @include('restaurant.partials._flash')

            <div class="card mb-3">
                <div class="card-header">
                    All stored orders
                </div>
                <div class="card-body">
                    <table class="table display" id="entities" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Created</th>
                            <th>Pick Up Time</th>
                            <th>Payment</th>
                            <th>Current Status</th>
                            <th>Customer</th>
                            <th>Balance</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->pickup_at->diffForHumans()}}</td>
                                <td>{{$order->payment_method}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>
                                    @if($order->payment_method == 'cantina')
                                        <span data-toggle="tooltip" title="Balance Available">{{$order->user->balances()->count()}}</span>/<span data-toggle="tooltip" title="Quantity in this order">{{$order->getTotalQuantityOrder()}}</span>
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route("restaurant.orders.detail", ["id" => $order->id]) }}" data-toggle="modal"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                                    @if($order->status === "created")
                                        <a class="btn btn-danger btn-sm" href="{{ route("restaurant.orders.change", ["id" => $order->id, "status" => "cooking"]) }}" data-toggle="change">Cooking</a>
                                    @elseif($order->status === "cooking")
                                        <a class="btn btn-success btn-sm" href="{{ route("restaurant.orders.change", ["id" => $order->id, "status" => "cooked"]) }}" data-toggle="change">Cooked</a>
                                    @elseif($order->status === "cooked")

                                        @if($order->user->balances()->count() < $order->getTotalQuantityOrder() && $order->payment_method == 'cantina')
                                            <a class="btn btn-success btn-sm disabled" href="#" data-toggle="change">Re Charge</a>
                                        @else
                                            <a class="btn btn-success btn-sm" href="{{ route("restaurant.orders.change", ["id" => $order->id, "status" => "delivered"]) }}" data-toggle="change">Delivered</a>
                                        @endif

                                    @else
                                        <a class="btn btn-default btn-sm disabled" data-toggle="change">Pending to Archive</a>
                                    @endif

                                    @if($order->user->balances()->count() < $order->getTotalQuantityOrder() && $order->payment_method == 'cantina')
                                        <a class="btn btn-success btn-sm load-balance" href="{{ route("restaurant.balance.create", ["id" => $order->user_id]) }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Load</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>

@endsection('content')

@section('javascript')
    <script>
        $(document).ready( function () {
            $('[data-toggle="modal"]').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (url.indexOf('#') == 0) {
                    $(url).modal('open');
                } else {
                    $.get(url, function(data) {
                        $('<div class="modal hide fade">' + data + '</div>').modal();
                    });
                }
            });

            $('[data-toggle="change"]').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (url.indexOf('#') == 0) {
                    $(url).modal('open');
                } else {
                    $.get(url, function(data) {
                        $('<div class="modal hide fade">' + data + '</div>').modal();
                    });
                }
            });

            $('.load-balance').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (url.indexOf('#') == 0) {
                    $(url).modal('open');
                } else {
                    $.get(url, function(data) {
                        $('<div class="modal hide fade">' + data + '</div>').modal();
                    });
                }
            });
        });
    </script>
@endsection('javascript')