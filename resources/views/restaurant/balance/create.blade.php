@extends('restaurant.base')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('restaurant.partials._flash')
            <div class="card mb-3">
                <div class="card-header">
                    Recharge balance for: <strong>{{ $user->name }}</strong>
                </div>
                <div class="card-body">
                    <h5>Current Balance: {{ $user->balances()->count() }}</h5>
                    <form method="post" action="{{ route('restaurant.balance.store', ['user' => $user->id]) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="form-control-label">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" placeholder="Place the quantity " value="{{ old('quantity') }}">
                            @if($errors->first('quantity'))
                                <div class="form-control-feedback">{{$errors->first('quantity')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Invoice Number:</label>
                            <input type="text" class="form-control" name="invoice" placeholder="Place the invoice number " value="{{ old('invoice') }}">
                            @if($errors->first('invoice'))
                                <div class="form-control-feedback">{{$errors->first('invoice')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('restaurant.balance.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Add Balance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection('content')

