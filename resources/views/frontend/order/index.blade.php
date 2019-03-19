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
                        <div class="row">
                            <div class="order-inner">
                                <div class="order-content">
                                    <div class="order-id">
                                        <h2>{{ trans('frontend.orders.my_history') }}</h2>
                                    </div>

                                    <div class="order-info">
                                        <div class="order-info-inner">
                                            <table id="order_details">
                                                <thead>
                                                <tr>
                                                    <th>{{ trans('frontend.orders.products') }}</th>
                                                    <th>{{ trans('frontend.orders.date') }}</th>
                                                    <th>{{ trans('frontend.orders.quantity') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orders as $order)
                                                        <tr id="10324769618" class="odd">
                                                            <td class="td-product">
                                                                {{ $order->products()->pluck('name') }}
                                                            </td>
                                                            <td class="sku note">{{ $order->create_at->format('Y-m-d H:i:s') }}</td>
                                                            <td class="money">
                                                                {{ $order->products()->count() }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if($orders->count() === 0)
                                                        <tr id="10324769618" class="odd">
                                                            <td class="td-product" colspan="3">
                                                                {{ trans('frontend.orders.no_orders_added_yet') }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection
