@extends('frontend.base')

@section('body_class', '')

@section('content')
    @include('frontend.partials._flash')

    <main
        class="main-content"
        id="index-products"
        role="main"
        data-categories="{{ json_encode($categories) }}"
        data-sides="{{ json_encode($sides) }}"
        data-data-provider="{{ asset('graphql') }}"
        @if(Auth::check())
            data-signed-in="true"
        @else
            data-signed-in="false"
        @endif
    ></main>
@endsection

@section('javascript')

    <script type="text/javascript" src="{{ asset('dist/frontend/js/home/index.js') }}"></script>
@endsection


