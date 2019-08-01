@extends('frontend.base')

@section('body_class', '')

@section('content')
    @include('frontend.partials._flash')

    <div class="page-container" id="PageContainer">
        <main class="main-content" id="MainContent" role="main">
           <section class="account-layout">
                <div class="account-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="account-inner">
                                <div class="account-content">
                                    <div class="account-info">
                                        <div class="account-details col-sm-6">
                                            <h3 class="details-title">
                                                {{ trans('frontend.profile.account_details') }}
                                            </h3>
                                            <div class="details-content">
                                                <div class="details-item name">
                                                    <span class="title">
                                                        {{ trans('frontend.profile.name') }}:
                                                    </span>
                                                    <span class="content">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                </div>
                                                <div class="details-item">
                                                    <span class="title">
                                                        {{ trans('frontend.profile.email') }}:
                                                    </span>
                                                    <a class="content">
                                                        {{ Auth::user()->email }}
                                                    </a>
                                                </div>
                                                <div class="details-item name">
                                                    <span class="title">
                                                        {{ trans('frontend.profile.balance') }}:
                                                    </span>
                                                    <a class="content">
                                                        {{ Auth::user()->balances()->count() }}
                                                        @if(Auth::user()->balances()->count() === 0)
                                                            {{ trans('frontend.profile.recharged_required') }}
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account-link col-sm-6">
                                            <h3 class="link-title">{{ trans('frontend.profile.my_account') }}</h3>
                                            <div class="link-content">
                                                <ul class="link-list">
                                                    <li class="item">
                                                        <a href="{{ route('frontend.logout') }}">
                                                            {{ trans('frontend.logout') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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


