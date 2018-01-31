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
                            <th>Customer</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route("restaurant.orders.detail", ["id" => $order->id]) }}" data-toggle="modal">Order Detail</a>
                                    @if($order->status === "created")
                                        <a class="btn btn-danger btn-sm" href="{{ route("restaurant.orders.change", ["id" => $order->id, "status" => "cooking"]) }}" data-toggle="change">Cook</a>
                                    @elseif($order->status === "cooking")
                                        <a class="btn btn-success btn-sm" href="{{ route("restaurant.orders.change", ["id" => $order->id, "status" => "delivery"]) }}" data-toggle="change">Deliver</a>
                                    @else
                                        <a class="btn btn-default btn-sm disabled" data-toggle="change">Delivered</a>
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
        });
    </script>
@endsection('javascript')