@extends('restaurant.partials._form')

@section('form')

    <form method="post">

        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        @include('restaurant.employee._form')
    </form>

@endsection('form')

@section('javascript')
    <script>

    </script>
@endsection