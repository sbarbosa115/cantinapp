@extends('restaurant.base')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('restaurant.partials._flash')
            <div class="card mb-3">
                <div class="card-header">
                    Customer: <strong>{{ $user->name }}</strong>
                </div>
                <div class="card-body">
                    <h5>Current Balance: {{ $user->balances()->count() }}</h5>
                    <table class="table">
                        @if($items->count())
                            <thead>
                            <caption>Dishes taken</caption>
                            <tr>
                                <th>Dish</th>
                                <th>Date Created</th>
                                <th>Date Taken</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="text-center">{{ $item->getProductAttribute('name') }}</td>
                                    <td>{{ $item->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $item->updated_at->toFormattedDateString()  }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                            <h5>This user has not yet ordered.</h5>
                        @endif
                    </table>
                    <div class="form-group">
                        <a href="{{ route('restaurant.balance.index') }}" class="btn btn-danger">Back</a>
                    </div
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection('content')
