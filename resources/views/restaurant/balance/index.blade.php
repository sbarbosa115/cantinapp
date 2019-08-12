@extends('restaurant.base')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('restaurant.partials._flash')
            <div class="card mb-3">
                <div class="card-header">
                    Recharge user's balance
                </div>
                <div class="card-body">
                    <table class="table display" id="entities" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->balances()->count()}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm " href="{{ route('restaurant.balance.log', ['user' => $item->id]) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Log
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('restaurant.balance.create', ['user' => $item]) }}">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i> Load
                                    </a>
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
    <script type="text/javascript" src="{{ mix('dist/restaurant/js/balance/index.js') }}"></script>
@endsection('javascript')
