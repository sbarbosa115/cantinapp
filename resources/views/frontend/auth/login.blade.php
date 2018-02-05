@extends('frontend.base')

@section('content')

    <!-- Main Content -->
    <div class="page-container" id="PageContainer">
        <main class="main-content" id="MainContent" role="main">
            <section class="customers-layout login-layout">
                <div class="customers-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="customers-inner">
                                <div class="customers-content">
                                    <div id="login" class="customers">
                                        <h2>Login</h2>

                                        {{ dump($errors) }}

                                        <form method="post" action="{{ route('frontend.login') }}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <div class="clearfix large_form form-item">
                                                <input type="email" value="" placeholder="Email Address" name="email" id="customer_email" class="text">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="clearfix large_form form-item form-password">
                                                <input type="password" value="" placeholder="Password" name="password" id="customer_password" class="text" size="16">
                                                <span class="cs-icon icon-eye"></span>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="clearfix">
                                                <a class="note" href="#" onclick="showRecoverPasswordForm();return false;">Forgot your password?</a>
                                            </div>
                                            <div class="action_bottom">
                                                <input class="_btn" type="submit" value="Sign In">
                                            </div>
                                        </form>
                                        <div class="create-account">
                                            <h4>You don't have account?</h4>
                                            <a href="./register.html" class="_btn">Create account now</a>
                                        </div>
                                    </div>

                                    <div id="recover-password" style="display:none;" class="customers">
                                        <h2>Reset Password</h2>
                                        <p class="note">We will send you an email to reset your password.</p>
                                        <form method="post" action="./login.html" accept-charset="UTF-8">
                                            <div class="clearfix large_form form-item">
                                                <input type="email" value="" placeholder="Email Address" size="30" name="email" id="recover-email" class="text">
                                            </div>
                                            <div class="action_bottom clearfix">
                                                <input class="_btn" type="submit" value="Login">
                                            </div>
                                            <div class="clearfix note_text_group">
                                                or<span class="note_link"><a href="#" onclick="hideRecoverPasswordForm();return false;">Cancel</a></span>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script type="text/javascript">
                function showRecoverPasswordForm() {
                    document.getElementById('recover-password').style.display = 'block';
                    document.getElementById('login').style.display = 'none';
                }

                function hideRecoverPasswordForm() {
                    document.getElementById('recover-password').style.display = 'none';
                    document.getElementById('login').style.display = 'block';
                }

                if (window.location.hash == '#recover') {
                    showRecoverPasswordForm()
                }
            </script>
        </main>
    </div>

@endsection('content')