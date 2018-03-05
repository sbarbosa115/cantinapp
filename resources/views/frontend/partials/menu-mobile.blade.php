<div class="navMobile-navigation">
    <div class="navMobile-logo">
        <a href="/">
            <img class="header-logo-image" src="{{ asset("/frontend/images/170x177.png") }}" alt="" title="Cantinapp">
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
										<span class="number">2</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu cart-info">
                        <div class="cart-content">
                            <div class="text-items"><span>2 item(s) in the shopping cart</span>
                                <span class="cs-icon icon-close close-dropdown"></span>
                            </div>
                            <div class="items control-container">
                                <div class="group_cart_item">
                                    <div class="cart-left">
                                        <a class="cart-image" href="./product.html">
                                            <img src="./assets/images/800x800.png" alt="" title="">
                                        </a>
                                    </div>
                                    <div class="cart-right">
                                        <div class="cart-title">
                                            <a href="./product.html">Extra Crispy - Small / Black / Black Bottom Cupcakes</a>
                                        </div>
                                        <div class="cart-price">
                                            <span class="money" data-currency-usd="$10.00" data-currency="USD">$10.00</span>
                                        </div>
                                        <div class="cart-qty">
                                            <span class="quantity">Qty: 1</span>
                                            <a title="Add To Wishlist" class="wishlist-extra-crispy-1" href="./wish-list.html">
                                                <span class="cs-icon icon-heart"></span>
                                            </a>
                                            <a class="cart-close" title="Remove" href="javascript:void(0);">
                                                <span class="cs-icon icon-bin"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="group_cart_item">
                                    <div class="cart-left">
                                        <a class="cart-image" href="./product.html">
                                            <img src="./assets/images/800x800.png" alt="" title="">
                                        </a>
                                    </div>
                                    <div class="cart-right">
                                        <div class="cart-title">
                                            <a href="./product.html">Juice Ice Tea</a>
                                        </div>
                                        <div class="cart-price">
                                            <span class="money" data-currency-usd="$10.00" data-currency="USD">$10.00</span>
                                        </div>
                                        <div class="cart-qty">
                                            <span class="quantity">Qty: 2</span>
                                            <a title="Add To Wishlist" class="wishlist-extra-crispy-1" href="./wish-list.html">
                                                <span class="cs-icon icon-heart"></span>
                                            </a>
                                            <a class="cart-close" title="Remove" href="javascript:void(0);">
                                                <span class="cs-icon icon-bin"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subtotal"><span>Subtotal:</span><span class="cart-total-right money" data-currency-usd="$30.00" data-currency="USD">$30.00</span></div>
                            <div class="action">
                                <button class="_btn" onclick="window.location='./cart.html'">View All Your Cart</button>
                                <button class="_btn float-right" onclick="window.location='./cart.html'">Proceed To Checkout</button>
                            </div>
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
                                Home
                            </a>

                            @if(Auth::user())
                                <a href="{{ route("frontend.order.show") }}">
                                    My Current Order
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>