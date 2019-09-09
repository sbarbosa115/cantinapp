@extends('restaurant.base')


@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('restaurant.partials._flash')
            <div class="card card-register">
                <div class="card-header">My Account</div>
                <div class="card-body">
                    <form action="{{ route('restaurant.account.update') }}" method="post">
                        <div class="form-group">
                            <label class="form-control-label">Public Domain:</label>
                            <input type="text" class="form-control disabled" value="{{request()->server->get('SERVER_NAME')}}">
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-control-label">Restaurant Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $restaurant->name }}" placeholder="Restaurant Name" required="required">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $restaurant->phone }}" placeholder="Phone" required="required">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $restaurant->address }}" placeholder="Address" required="required">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Welcome Text</label>
                            <textarea class="form-control" name="welcome_text">{{ $restaurant->welcome_text }}</textarea>
                        </div>
                        <div class="form-group">
                            {{ csrf_field() }}
                            <button class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection('content')
