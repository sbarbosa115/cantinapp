@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            @yield("form")
        </div>
    </div>

@endsection('content')

@section('javascript')
    @yield("javascript")
@endsection('javascript')