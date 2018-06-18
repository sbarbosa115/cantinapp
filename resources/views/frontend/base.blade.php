<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="/" />
    <meta name="theme-color" content="#7796A8">
    <meta name="description" content="" />
    <title> Fast Food</title>

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playball:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="{{  asset('frontend/css/app.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{  asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css" media="all">
</head>

<body class="fastfood_1 @yield('body_class')">

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
                                    <a href="{{ url("/") }}">
                                        <img src="http://via.placeholder.com/170x101" alt="" title="Cantinapp" />
                                    </a>
                                    <h1 style="display:none">
                                        <a href="/">Cantinapp </a>
                                    </h1>
                                </div>

                                @include('frontend.partials.menu-desktop')

                                @include('frontend.partials.menu-mobile')

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
<div class="page-container" id="PageContainer">
    <main class="main-content" id="MainContent" role="main">

        @yield('content')

    </main>
</div>

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

<div class="modal fade" id="modal-messages"></div>

<script type="text/javascript" src="{{ asset('frontend/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script>
@yield('javascript')

</body>