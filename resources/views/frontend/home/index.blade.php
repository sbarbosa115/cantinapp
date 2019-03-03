@extends('frontend.base')

@section('body_class', '')

@section('content')
    @include('frontend.partials._flash')

    <main
        class="main-content"
        id="index-products"
        role="main"
        data-categories="{{ json_encode($categories) }}"
    ></main>
@endsection

@section('javascript')

    <script type="text/javascript" src="{{ asset('dist/frontend/js/home/index.js') }}"></script>
@endsection


