<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="/" />
    <meta name="theme-color" content="#7796A8">
    <meta name="description" content="" />
    <title>
        Fast Food
    </title>

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playball:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{  asset('frontend/css/app.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">


    <script type="text/javascript" src="{{ asset('frontend/js/app.js') }}"></script>

</head>



<body class="fastfood_1" >

<!--Header-->
<header id="top" class="header clearfix">
    <div id="shopify-section-theme-header" class="shopify-section">
        <div data-section-id="theme-header" data-section-type="header-section">
            <section class="main-header">
                <div class="main-header-wrapper">
                    <div class="container clearfix">
                        <div class="row">
                            <div class="main-header-inner">
                                <div class="nav-logo">
                                    <a href="./index.html"><img src="./assets/images/170x177.png" alt="" title="Fast Food" /></a>
                                    <h1 style="display:none"><a href="/">Fast Food</a></h1>
                                </div>
                                <div class="nav-top">
                                    <div class="nav-menu">
                                        <ul class="navigation-links ">
                                            <li class="nav-item">
                                                <a href="./super-deal.html">
                                                    <span>Combo buy</span>
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown navigation">
                                                <a href="./contact.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
                                                    <span>Pages</span>
                                                    <i class="fa fa-angle-down"></i>
                                                    <i class="sub-dropdown1  visible-sm visible-md visible-lg"></i>
                                                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./blog.html">Blogs</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./about-us.html">About Us</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./contact.html">Contact</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./faqs.html">FAQs</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./lookbook.html">Lookbook</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./super-deal.html">Super Deal</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./404.html">404</a>
                                                    </li>
                                                    <li class="li-sub-mega">
                                                        <a tabindex="-1" href="./collections-all.html">All Collections</a>
                                                    </li>
                                                </ul>
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
                                                <div class="m_dropdown-login dropdown-menu login-content">
                                                    <div class="clearfix">
                                                        <div class="login-register-content">
                                                            <ul class="nav nav-tabs">
                                                                <li class="account-item-title active">
                                                                    <a href="#account-login" data-toggle="tab">
                                                                        Login
                                                                    </a>
                                                                </li>
                                                                <li class="account-item-title">
                                                                    <a href="#account-register" data-toggle="tab">
                                                                        Register
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content group_form">
                                                                <div class="tab-pane active account-item-content" id="account-login">
                                                                    <form method="post" action="./login.html" id="customer_login" accept-charset="UTF-8">
                                                                        <div class="clearfix large_form form-item">
                                                                            <input type="email" value="" name="customer[email]" class="form-control" placeholder="Email Address *" />
                                                                        </div>
                                                                        <div class="clearfix large_form form-password form-item">
                                                                            <input type="password" value="" name="customer[password]" class="form-control password" placeholder="Password *" />
                                                                            <span class="cs-icon icon-eye"></span>
                                                                        </div>
                                                                        <div class="action_bottom">
                                                                            <button class="_btn" type="submit">Login</button>
                                                                            <a href="./login-recover.html"><span class="red"></span> Forgot your password?</a>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="tab-pane account-item-content " id="account-register">
                                                                    <form method="post" action="./register.html" id="create_customer" accept-charset="UTF-8">
                                                                        <div class="clearfix large_form form-item">
                                                                            <input placeholder="First Name" type="text" value="" name="customer[first_name]" id="first_name" class="text" size="30" />
                                                                        </div>
                                                                        <div class="clearfix large_form form-item">
                                                                            <input placeholder="Last Name" type="text" value="" name="customer[last_name]" id="last_name" class="text" size="30" />
                                                                        </div>
                                                                        <div class="clearfix large_form form-item">
                                                                            <input placeholder="Email" type="email" value="" name="customer[email]" id="email" class="text" size="30" />
                                                                        </div>
                                                                        <div class="clearfix large_form form-password form-item">
                                                                            <input placeholder="Password" type="password" value="" name="customer[password]" id="password" class="password text" size="30" />
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="navMobile-navigation">
                                    <div class="navMobile-logo">
                                        <a href="./index.html"><img class="header-logo-image" src="./assets/images/170x177.png" alt="" title="Fast Food" /></a>
                                    </div>
                                    <div class="group_mobile_right">
                                        <div class="nav-icon">
                                            <div class="m_search search-tablet-icon">
													<span class="dropdownMobile-toggle search-dropdown">
														<span class="icon-dropdown cs-icon icon-search" data-class="cs-icon icon-search"></span>
														<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
														<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
													</span>
                                                <div class="m_dropdown-search dropdown-menu search-content">
                                                    <form class="search" action="./search.html">
                                                        <input type="hidden" name="type" value="product" />
                                                        <input type="text" name="q" class="search_box" placeholder="search our store" value="" />
                                                        <span class="search-clear cs-icon icon-close"></span>
                                                        <button class="search-submit" type="submit">
                                                            <span class="cs-icon icon-search"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
                                                            <div class="text-items"><span>2 item(s) in the shopping cart</span> <span class="cs-icon icon-close close-dropdown"></span> </div>
                                                            <div class="items control-container">
                                                                <div class="group_cart_item">
                                                                    <div class="cart-left"><a class="cart-image" href="./product.html"><img src="./assets/images/800x800.png" alt="" title=""></a></div>
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
                                                                    <div class="cart-left"><a class="cart-image" href="./product.html"><img src="./assets/images/800x800.png" alt="" title=""></a></div>
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
                                                            <div class="action"><button class="_btn" onclick="window.location='./cart.html'">View All Your Cart</button><button class="_btn float-right" onclick="window.location='./cart.html'">Proceed To Checkout</button></div>
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
                                                                        <form method="post" action="./login.html" id="customer_login_mobile" accept-charset="UTF-8">
                                                                            <div class="clearfix large_form form-item">
                                                                                <input type="email" value="" name="customer[email]" class="form-control" placeholder="Email Address *" />
                                                                            </div>
                                                                            <div class="clearfix large_form form-password form-item">
                                                                                <input type="password" value="" name="customer[password]" class="form-control password" placeholder="Password *" />
                                                                                <span class="cs-icon icon-eye"></span>
                                                                            </div>
                                                                            <div class="action_bottom">
                                                                                <button class="_btn" type="submit">Login</button>
                                                                                <a href="./login-recover.html"><span class="red"></span> Forgot your password?</a>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane account-item-content " id="account-register-mobile">
                                                                        <form method="post" action="./register.html" id="create_customer_mobile" accept-charset="UTF-8">
                                                                            <div class="clearfix large_form form-item">
                                                                                <input placeholder="First Name" type="text" value="" name="customer[first_name]" class="text" size="30" />
                                                                            </div>
                                                                            <div class="clearfix large_form form-item">
                                                                                <input placeholder="Last Name" type="text" value="" name="customer[last_name]" class="text" size="30" />
                                                                            </div>
                                                                            <div class="clearfix large_form form-item">
                                                                                <input placeholder="Email" type="email" value="" name="customer[email]" class="text" size="30" />
                                                                            </div>
                                                                            <div class="clearfix large_form form-password form-item">
                                                                                <input placeholder="Password" type="password" value="" name="customer[password]" class="password text" size="30" />
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
                                                        <li class="nav-item navigation navigation_mobile">
                                                            <a href="./collections.html" class="menu-mobile-link">
                                                                Hamburger
                                                            </a>
                                                            <a href="javascript:void(0)" class="arrow_sub arrow">
                                                                <i class="arrow-plus"></i>
                                                            </a>
                                                            <ul class="menu-mobile-container" style="display: none;">
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Whopper</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Chicken Burger</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Beef Burger</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">DOUBLE WHOPPER</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item navigation navigation_mobile">
                                                            <a href="./collections.html" class="menu-mobile-link">
                                                                Pizza
                                                            </a>
                                                            <a href="javascript:void(0)" class="arrow_sub arrow">
                                                                <i class="arrow-plus"></i>
                                                            </a>
                                                            <ul class="menu-mobile-container" style="display: none;">
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Popular pizzas</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Meats</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Chicken</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections.html">Veggie</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="./collections.html">
                                                                Fast food
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="./collections.html">
                                                                Drinks
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="./super-deal.html">
                                                                Combo buy
                                                            </a>
                                                        </li>
                                                        <li class="nav-item navigation navigation_mobile">
                                                            <a href="./contact.html" class="menu-mobile-link">
                                                                Pages
                                                            </a>
                                                            <a href="javascript:void(0)" class="arrow_sub arrow">
                                                                <i class="arrow-plus"></i>
                                                            </a>
                                                            <ul class="menu-mobile-container" style="display: none;">
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./blog.html">Blogs</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./about-us.html">About Us</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./contact.html">Contact</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./faqs.html">FAQs</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./lookbook.html">Lookbook</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./super-deal.html">Super Deal</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./404.html">404</a>
                                                                </li>
                                                                <li class=" li-sub-mega">
                                                                    <a tabindex="-1" href="./collections-all.html">All Collections</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</header>
<div class="fix-sticky"></div>

<!-- Main Content -->
@yield('content')

<!-- Footer -->
<footer class="footer">
    <div id="shopify-section-theme-footer" class="shopify-section">
        <section class="footer-information-block clearfix" style="background-image:  url(./assets/images/1600x437.png);">
            <div class="container">
                <div class="row">
                    <div class="footer-information-inner">
                        <div class="footer-information-content">
                            <div class="information-item col-sm-4 not-animated" data-animate="fadeInUp" data-delay="100">
                                <div class="about-content">
                                    <div class="logo-footer">
                                        <img src="./assets/images/113x118.png" alt="" />
                                    </div>
                                    <div class="about-caption">
                                        Skort Maison Martin Margiela knot ponytail cami texture tucked t-shirt. Black skirt razor pleats plaited gold collar.
                                        <div class="clearfix" style="margin-bottom: 5px; "></div>
                                        Crop 90s spearmint indigo seam luxe washed out. Prada Saffiano cash mere crop sneaker chignon
                                    </div>
                                    <div class="about-contact">
                                        <div class="item">
                                            <span class="cs-icon icon-marker"></span><address>No 1104 Sky Tower, Las Vegas, USA</address>
                                        </div>
                                        <div class="item">
                                            <span class="cs-icon icon-phone"></span><a href="tel:(084)0123456789">(084) 0123 456 789</a>
                                        </div>
                                        <div class="item">
                                            <span class="cs-icon icon-mail"></span><a href="mailto:contac@yourcompany.com">contac@yourcompany.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="social-payment-item col-sm-4 not-animated" data-animate="fadeInUp" data-delay="300">
                                <h5 class="footer-title"> Follow Us</h5>
                                <div class="social-content">
                                    <div class="social-caption">
                                        <a href="https://www.facebook.com/shopify" title="Fast Food on Facebook" class="icon-social facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/shopify" title="Fast Food on Twitter" class="icon-social twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="https://plus.google.com/+shopify" title="Fast Food on Google+" class="icon-social google-plus"><i class="fa fa-google-plus"></i></a>
                                        <a href="https://www.pinterest.com/shopify" title="Fast Food on Pinterest" class="icon-social pinterest"><i class="fa fa-pinterest"></i></a>
                                        <a href="https://instagram.com/shopify" title="Fast Food on Instagram" class="icon-social instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="https://www.youtube.com/user/shopify" title="Fast Food on Youtube" class="icon-social youtube"><i class="fa fa-youtube"></i></a>
                                    </div>
                                </div>
                                <div class="payment-content ">
                                    <h5 class="footer-title">Payment Methods</h5>
                                    <div class="payment-caption">
                                        <span class="icon-cc icon-cc-discover" title="Discover"></span>
                                        <span class="icon-cc icon-cc-american" title="Amex"></span>
                                        <span class="icon-cc icon-cc-western" title="Western Union"></span>
                                        <span class="icon-cc icon-cc-paypal" title="PayPal"></span>
                                        <span class="icon-cc icon-cc-moneybookers" title="MoneyBookers"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="copy-right clearfix">
            <div class="copy-right-wrapper">
                <div class="copy-right-inner">
                    <div class="footer_links">
                        <ul>
                            <li><a href="./index.html" title="Home">Home</a></li>
                            <li><a href="./collections.html" title="Pizza">Pizza</a></li>
                            <li><a href="./collections.html" title="Hamburger">Hamburger</a></li>
                            <li><a href="./collections.html" title="Fast food">Fast food</a></li>
                            <li><a href="./collections.html" title="Drinks">Drinks</a></li>
                            <li><a href="./collections.html" title="Combo buy">Combo buy</a></li>
                            <li><a href="./contact.html" title="Contact">Contact</a></li>
                            <li><a href="./wish-list.html" title="Wishlist">Wishlist</a></li>
                            <li><a href="./account.html" title="My account">My account</a></li>
                            <li><a href="./login.html" title="Login">Login</a></li>
                        </ul>
                    </div>
                    <div class="footer_copyright">Copyright &copy; 2017 <a href="./index.html" title="">Fast Food</a>. All Rights Reserved</div>
                </div>
            </div>
        </section>
    </div>
</footer>


</body>