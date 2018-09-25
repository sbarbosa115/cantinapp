@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <a class="card-footer text-white clearfix small z-1" href="{{ route('restaurant.employee.create') }}" id="create-item">
                            <span class="float-left">Create new employee</span>
                            <span class="float-right">
                            <i class="fa fa-users"></i>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('restaurant.employee.edit', ['id' => $item->id]) }}">Edit</a>

                                    <form action="{{ route('restaurant.employee.delete', ['id' => $item->id]) }}" method="post" style="display: inline;">
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                    </form>
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