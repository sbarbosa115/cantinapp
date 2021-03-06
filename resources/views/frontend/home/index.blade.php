@extends('frontend.base')

@section('body_class', '')

@section('content')
    @include('frontend.partials._flash')

    <main
        class="main-content"
        id="index-products"
        role="main"
        data-data-provider="{{ asset('graphql') }}"
        data-path-create-order="{{ route('frontend.order.store') }}"
        data-path-login="{{ route('frontend.login') }}"
        data-image-success="{{ asset('images/cooking.jpg') }}"
        data-image-error="{{ asset('images/error.png') }}"
        data-image-header="{{ asset('images/header.jpg') }}"
        data-source-products-id="{{ $restaurant->id }}"
        data-welcome-text="{{ $restaurant->welcome_text }}"
        data-allow-orders="{{ $restaurant->allow_orders }}"
        @if(Auth::check())
            data-signed-in="true"
        @else
            data-signed-in="false"
        @endif
    ></main>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ mix('dist/frontend/js/home/index.js') }}"></script>
@endsection
