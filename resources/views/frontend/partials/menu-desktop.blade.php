<div class="nav-top">
    <div class="nav-menu">
        <ul class="navigation-links ">
            <li class="nav-item">
                <a href="{{ url('/') }}">
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("frontend.order.get.product") }}">
                    <span>My Current Order</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-icon">
        <div class="icon_cart">
            <div class="m_cart-group">
                <a class="cart dropdown-toggle dropdown-link" data-toggle="dropdown">
                    <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                    <div class="num-items-in-cart">
                        <div class="items-cart">
                            <div class="num-items-in-cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart_text">
								    Cart <span class="number">(2)</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu cart-info" style="display: none;">
                    <div class="cart-content">
                        <div class="text-items"><span>2 item(s) in the shopping cart</span> <span class="cs-icon icon-close close-dropdown"></span> </div>
                        <div class="items control-container">
                            <div class="group_cart_item">
                                <div class="cart-left">
                                    <a class="cart-image" href="./product.html"><img src="./assets/images/800x800.png" alt="" title=""></a>
                                </div>
                                <div class="cart-right">
                                    <div class="cart-title"><a href="./product.html">Extra Crispy - Small / Black / Black Bottom Cupcakes</a></div>
                                    <div class="cart-price"><span class="money" data-currency-usd="$10.00" data-currency="USD">$10.00</span></div>
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
                                    <a class="cart-image" href="./product.html"><img src="./assets/images/800x800.png" alt="" title=""></a>
                                </div>
                                <div class="cart-right">
                                    <div class="cart-title"><a href="./product.html">Juice Ice Tea</a></div>
                                    <div class="cart-price"><span class="money" data-currency-usd="$10.00" data-currency="USD">$10.00</span></div>
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
</div>