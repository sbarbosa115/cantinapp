@extends('frontend.base')

@section('body_class', '')

@section('content')
    <div class="page-container" id="PageContainer">
        <main
            class="main-content"
            id="order-list"
            role="main"
            data-orders="{{ json_encode($orders) }}"
            data-allow-orders="{{ $restaurant->allow_orders }}"
        >
        </main>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ mix('dist/frontend/js/order/index.js') }}"></script>
@endsection
