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
                            <div class="form-label-group">
                                <label for="name">Public Domain</label>
                                <input type="text" class="form-control disabled" value="{{ $restaurant->domain }}.{{request()->server->get('SERVER_NAME')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label for="name">Restaurant Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $restaurant->name }}" placeholder="Restaurant Name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $restaurant->phone }}" placeholder="Phone" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $restaurant->address }}" placeholder="Address" required="required">
                            </div>
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