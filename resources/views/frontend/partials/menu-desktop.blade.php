<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navigation-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('/') }}">
                        {{ trans('frontend.menu.home') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.order.index') }}">
                        {{ trans('frontend.menu.my_orders') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.order.profile') }}">
                        {{ trans('frontend.menu.my_profile') }}
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @guest
                <li>
                    <a href="{{ route('frontend.register') }}">
                        <span class="glyphicon glyphicon-user"></span>
                        {{ trans('frontend.menu.register') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.login') }}">
                        <span class="glyphicon glyphicon-log-in"></span>
                        {{ trans('frontend.menu.log_in') }}
                    </a>
                </li>
            @endguest
            @auth
                <li>
                    <a href="{{ route('frontend.order.profile') }}">
                        <i class="fa fa-balance-scale" aria-hidden="true"></i>
                        {{ trans('frontend.menu.balance') }} ({{ count(Auth::user()->balances) }})
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.logout') }}">
                        {{ trans('frontend.menu.logout') }}
                    </a>
                </li>
            @endauth
            </ul>
        </div>
    </div>
</nav>
