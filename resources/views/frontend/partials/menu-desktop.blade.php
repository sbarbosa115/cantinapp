<div class="nav-top">
    <div class="nav-menu">
        <ul class="navigation-links ">
            <li class="nav-item">
                <a href="{{ url('/') }}">
                    <span>Home</span>
                </a>
            </li>
            @if(Auth::user())
                <li class="nav-item">
                    <a href="{{ route("frontend.order.show") }}">
                        <span>My Current Order</span>
                    </a>
                </li>
            @endif
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
                                    @if(Session::has('order'))
                                        @php($products = Session::get('order'))
                                        Order <span class="number">({{ $products->count() }})</span>
                                    @else
                                        No products added yet.
                                    @endif

                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu cart-info" id="cart-info-desktop" style="display: none;">
                    <div class="cart-content">
                        <div class="text-items">
                            @if(Session::has('order'))
                                @php($products = Session::get('order'))
                                <span>{{ $products->count()  }} item(s) in this order</span>
                                <span class="cs-icon icon-close close-dropdown"></span>
                            @else
                                <span>No products added yet.</span>
                            @endif
                        </div>
                        @php($total = 0)
                        @if(Session::has('order'))
                            <div class="items control-container">
                                @foreach(Session::get('order') as $product)
                                    <div class="group_cart_item">
                                        <div class="cart-left">
                                            <a class="cart-image" href="./product.html">
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
                                    @php($total = $total  + ($product->price * $product->quantity))
                                @endforeach
                            </div>
                            <div class="subtotal">
                                <span>Subtotal:</span>
                                <span class="cart-total-right money">${{ $total }}</span>
                            </div>

                            <div class="action">
                                <button class="_btn float-right" onclick="window.location='{{ route("frontend.order.show") }}'">Proceed To Order</button>
                            </div>

                        @endif
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