@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <a class="card-footer text-white clearfix small z-1" href="{{ route("restaurant.product.create") }}" id="create-item">
                            <span class="float-left">Create new product</span>
                            <span class="float-right">
                            <i class="fa fa-product-hunt"></i>
                          </span>
                        </a>
                    </div>
                </div>
            </div>
            @include('restaurant.partials._flash')
            <div class="card mb-3">
                <div class="card-header">
                    All products stored
                </div>
                <div class="card-body">
                    <table class="table display" id="entities" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}}</td>
                                @if($product->category()->count())
                                    <td>{{ucfirst($product->category()->first()->name)}}</td>
                                @else
                                    <td>No category</td>
                                @endif
                                <td width="21%">
                                    <a class="btn btn-primary btn-sm" href="{{ route('restaurant.product.edit', ['id' => $product->id]) }}">Edit</a>
                                    <form action="{{ route('restaurant.product.delete', ['id' => $product->id]) }}" method="post" style="display: inline;">
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                    </form>
                                    @if($product->status === 'enabled')
                                        <a class="btn btn-warning btn-sm" href="{{ route('restaurant.product.change.status', ['product' => $product->id, 'status' => 'disabled']) }}">To Disable</a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{ route('restaurant.product.change.status', ['product' => $product->id, 'status' => 'enabled']) }}">To Enable</a>
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