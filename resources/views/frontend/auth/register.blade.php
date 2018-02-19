@extends('frontend.base')

@section('content')

<section class="customers-layout register-layout">
    <div class="customers-wrapper">
        <div class="container">
            <div class="row">
                <div class="customers-inner">
                    <div class="customers-content">
                        <div id="register" class="customers">
                            <h2>Register</h2>
                            <form class="form-horizontal" method="POST" action="{{ route('frontend.register') }}">
                                {{ csrf_field() }}

                                <div class="clearfix large_form form-item">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="clearfix large_form form-item">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="clearfix large_form form-password form-item">
                                    <input id="password" type="password" class="form-control password text" placeholder="Password" name="password" required>
                                    <span class="cs-icon icon-eye"></span>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="clearfix large_form form-password form-item">
                                    <input id="password_confirmation" type="password" class="form-control password text" placeholder="Password Confirmation" name="password_confirmation" required>
                                    <span class="cs-icon icon-eye"></span>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="action_bottom">
                                    <input class="_btn" value="Create" type="submit">
                                    <span class="note"><span class="or">or</span><a href="{{ route("frontend.home.index") }}">Return to Store</a></span>
                                </div>
                            </form>
                        </div>
                        <!-- #register -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
