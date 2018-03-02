<div class="m_dropdown-login dropdown-menu login-content">
    <div class="clearfix">
        <div class="login-register-content">
            <ul class="nav nav-tabs">
                <li class="account-item-title active">
                    <a href="#account-login-mobile" data-toggle="tab">
                        Login
                    </a>
                </li>
                <li class="account-item-title">
                    <a href="#account-register-mobile" data-toggle="tab">
                        Register
                    </a>
                </li>
            </ul>
            <div class="tab-content group_form">
                <div class="tab-pane active account-item-content" id="account-login-mobile">
                    <form method="post" action="{{ route('frontend.login') }}" id="customer_login_mobile" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="clearfix large_form form-item">
                            <input value="" name="email" class="form-control" placeholder="Email Address *" type="email">
                        </div>
                        <div class="clearfix large_form form-password form-item">
                            <input value="" name="password" class="form-control password" placeholder="Password *" type="password">
                            <span class="cs-icon icon-eye"></span>
                        </div>
                        <div class="action_bottom">
                            <button class="_btn" type="submit">Login</button>
                            <a href="./login-recover.html"><span class="red"></span> Forgot your password?</a>
                        </div>
                    </form>
                </div>
                <div class="tab-pane account-item-content " id="account-register-mobile">
                    <form method="post" action="{{ route('frontend.register') }}" id="create_customer_mobile" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="clearfix large_form form-item">
                            <input placeholder="First Name" value="" name="name" class="text" size="30" type="text">
                        </div>
                        <div class="clearfix large_form form-item">
                            <input placeholder="Email" value="" name="email" class="text" size="30" type="email">
                        </div>
                        <div class="clearfix large_form form-password form-item">
                            <input placeholder="Password" value="" name="password" class="password text" size="30" type="password">
                            <span class="cs-icon icon-eye"></span>
                        </div>
                        <div class="action_bottom">
                            <button class="_btn" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>