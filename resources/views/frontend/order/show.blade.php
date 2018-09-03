@extends('frontend.base')

@section('body_class', '')

@section('content')
    <div class="page-container" id="PageContainer">
        <main class="main-content" id="MainContent" role="main">
            <section class="heading-content">
                <div class="heading-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="page-heading-inner heading-group">
                                <div class="breadcrumb-group">
                                    <h1 class="hidden">Create Order</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="order-layout">
                <div class="order-wrapper">
                    <div class="container">
                        <div class="row" id="order-component" data-order='{!!  $order->toJson()!!}' data-customer='{!! Auth::user() !!}'></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection