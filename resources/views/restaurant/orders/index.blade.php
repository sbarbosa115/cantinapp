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
                            <th>Current Status</th>
                            <th>Customer</th>
                            <th>Balance</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="@if($order->hasPendingBalances()) bg-danger @endif">
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->pickup_at->diffForHumans()}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>
                                    <span data-toggle="tooltip" title="Balance Available">
                                        {{$order->user->balances()->count()}}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('restaurant.orders.detail', ['id' => $order->id]) }}" data-toggle="modal">
                                        <i class="fa fa-eye" aria-hidden="true"></i> {{ trans('restaurant.detail') }}
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('restaurant.orders.print', ['id' => $order->id]) }}" target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i> {{ trans('restaurant.print') }}
                                    </a>
                                    @if($order->status === 'created')
                                        <a class="btn btn-danger btn-sm" href="{{ route('restaurant.orders.change', ['id' => $order->id, 'status' => 'cooking']) }}" data-toggle="change">
                                            {{ trans('restaurant.cooking') }}
                                        </a>
                                    @elseif($order->status === 'cooking')
                                        <a class="btn btn-success btn-sm" href="{{ route('restaurant.orders.change', ['id' => $order->id, 'status' => 'cooked']) }}" data-toggle="change">
                                            {{ trans('restaurant.cooked') }}
                                        </a>
                                    @elseif($order->status === 'cooked')
                                        @if($order->hasPendingBalances() === false)
                                            <a class="btn btn-success btn-sm" href="{{ route('restaurant.orders.change', ['id' => $order->id, 'status' => 'delivered']) }}" data-toggle="change">
                                                {{ trans('restaurant.delivered') }}
                                            </a>
                                        @else
                                            <a class="btn btn-success btn-sm disabled" href="#" data-toggle="change">
                                                {{ trans('restaurant.must_recharge_before') }}
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn btn-default btn-sm disabled" data-toggle="change">
                                            {{ trans('restaurant.pending_to_archive') }}
                                        </a>
                                    @endif
                                    @if($order->user->balances()->count() === 0)
                                        <a class="btn btn-success btn-sm load-balance" href="{{ route('restaurant.balance.create', ['id' => $order->user_id]) }}">
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            {{ trans('restaurant.load') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($orders->count() === 0)
                            <tr>
                                <td colspan="6" class="text-center">
                                    {{ trans('restaurant.no_orders') }}
                                </td>
                            </tr>
                        @endif
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
        setTimeout(function() {
          window.location.reload(true);
        }, 20000);
    </script>
@endsection('javascript')
