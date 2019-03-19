<div class="nav-top">
    <div class="nav-menu">
        <ul class="navigation-links ">
            <li class="nav-item">
                <a href="{{ url('/') }}">
                    <span>{{ trans('frontend.menu.home') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.order.index') }}">
                    <span>{{ trans('frontend.menu.my_orders') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-icon">
        <div class="icon_accounts">
            <div class="m_login-account">
                <span class="dropdown-toggle login-icon" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                </span>
                @if(Auth::user())
                    @include('frontend.partials._menu-desktop-logged')
                @else
                    @include('frontend.partials._menu-desktop-login')
                @endif
            </div>
        </div>
    </div>
</div>
