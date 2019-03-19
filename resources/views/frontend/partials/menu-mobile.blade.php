<div class="navMobile-navigation">
    <div class="navMobile-logo">
        <a href="/">
            <img class="header-logo-image" src="{{ asset('/images/logo.svg') }}" alt="" title="Cantinapp">
        </a>
    </div>
    <div class="group_mobile_right">
        <div class="nav-icon">
            <div class="icon_accounts">
                <div class="m_login-account">
                    <span class="dropdownMobile-toggle login-icon">
                        <i class="icon-dropdown cs-icon icon-ellipsis" data-class="cs-icon icon-ellipsis" aria-hidden="true"></i>
                        <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                        <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                    </span>
                    @if(Auth::user())
                        @include('frontend.partials._menu-mobile-logged')
                    @else
                        @include('frontend.partials._menu-mobile-login')
                    @endif
                </div>
            </div>
        </div>
        <div class="navMobile-menu">
            <div class="group_navbtn">
                <a href="javascript:void(0)" class="dropdown-toggle-navigation">
                    <span class="cs-icon icon-menu"></span>
                    <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                </a>
                <div class="navigation_dropdown_scroll dropdown-menu">
                    <ul class="navigation_links_mobile">
                        <li class="nav-item">
                            <a href="{{ url('/') }}">
                                {{ trans('frontend.menu.home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('frontend.order.index') }}">
                                <span>{{ trans('frontend.menu.my_orders') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
