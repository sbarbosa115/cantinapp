@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @yield("form")
            </form>
        </div>
    </div>

@endsection('content')

@section('javascript')
    @yield("javascript")
@endsection('javascript')