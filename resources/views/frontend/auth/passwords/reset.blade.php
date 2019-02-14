@extends('frontend.base')

@section('content')

<div class="page-container" id="PageContainer">
    <main class="main-content" id="MainContent" role="main">
        <section class="customers-layout login-layout">
            <div class="customers-wrapper">
                <div class="container">
                    <div class="row">
                        @include('frontend.partials._flash')

                        <div class="customers-inner">
                            <div class="customers-content">
                                <div class="customers">
                                    <h2>{{ trans('frontend.menu.password_recovery') }}</h2>
                                    <form class="form-horizontal" method="POST" action="{{ route('frontend.password.request') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="clearfix large_form form-item">
                                            <input type="email" placeholder="Email Address" name="email" class="text">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="clearfix large_form form-item">
                                            <input type="password" placeholder="Password" name="password" class="text">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="clearfix large_form form-item">
                                            <input type="password" placeholder="Confirm Password" name="password_confirmation" class="text">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="action_bottom">
                                            <input class="_btn" type="submit" value="Reset Password">
                                        </div>
                                    </form>
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
