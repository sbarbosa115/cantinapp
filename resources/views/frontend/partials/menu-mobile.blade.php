<div class="navMobile-navigation">
    <div class="navMobile-logo">
        <a href="/">
            <img class="header-logo-image" src="{{ asset('/images/logo.svg') }}" alt="" title="Cantinapp">
        </a>
    </div>
    <div class="group_mobile_right">
        <div class="nav-icon">
            <div class="icon_cart">
                <div class="m_cart-group">
                    <a class="cart dropdownMobile-toggle dropdown-link">
                        <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                        <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                        <div class="num-items-in-cart">
                            <div class="items-cart">
                                <div class="num-items-in-cart">
                                    <span class="cs-icon icon-bag"></span>
                                    <span class="cart_text">
										@if(Session::has('order'))
                                            @php($products = Session::get('order'))
                                            {{ trans('frontend.menu.order') }} <span class="number">({{ $products->count() }})</span>
                                        @else
                                            {{ trans('frontend.menu.no_products_added') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu cart-info">
                        <div class="cart-content">
                            <div class="text-items">
                                <div class="text-items">
                                    @if(Session::has('order'))
                                        @php($products = Session::get('order'))
                                        <span>{{ $products->count()  }} item(s) in this order</span>
                                        <span class="cs-icon icon-close close-dropdown"></span>
                                    @else
                                        <span>{{ trans('frontend.menu.no_products_added') }}</span>
                                    @endif
                                </div>
                            </div>
                            @php($total = 0)
                            @php($products = collect([]))
                            @if(Session::has('order'))
                                @if(Session::has('order'))
                                    <div class="items control-container">
                                        @foreach(Session::get('order') as $product)
                                            @if(!$products->contains('name', $product->name))
                                                <?php $products->push($product); ?>
                                                <div class="group_cart_item">
                                                    <div class="cart-left">
                                                        <a class="cart-image" href="#">
                                                            <img src="{{ asset($product->image_path) }}">
                                                        </a>
                                                    </div>
                                                    <div class="cart-right">
                                                        <div class="cart-title">
                                                            <a href="#">{{  $product->name }}</a>
                                                        </div>
                                                        <div class="cart-price">
                                                            <span class="money">${{ $product->price * $product->quantity }}</span>
                                                        </div>
                                                        <div class="cart-qty">
                                                            <span class="quantity">Qty: {{ $product->quantity }}</span>
                                                            <a class="cart-close" title="Remove" href="javascript:void(0);">
                                                                <span class="cs-icon icon-bin"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php($total += ($product->price * $product->quantity))
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="action">
                                        <button class="_btn float-right" onclick="window.location='{{ route('frontend.order.show') }}'">Proceed To Order</button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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

                            @if(Auth::user())
                                <a href="{{ route('frontend.order.show') }}">
                                    {{ trans('frontend.menu.my_current_order') }}
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
