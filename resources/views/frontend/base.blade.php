<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="/" />
    <meta name="theme-color" content="#7796A8">
    <title>Cantinapp - {{ trans('frontend.homepage.title') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playball:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ mix('dist/frontend/css/app.css') }}" rel="stylesheet" type="text/css" media="all">
    @yield('head_javascripts')

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

                                @include('frontend.partials.menu-desktop')

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
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer">
    <div id="shopify-section-theme-footer" class="shopify-section">
        <section class="footer-information-block clearfix">
            <div class="container">
                <div class="row">
                    <div class="footer-information-inner">
                        <div class="footer-information-content">
                            <div class="information-item col-sm-4 not-animated" data-animate="fadeInUp" data-delay="100">
                                <div class="about-content">
                                    <div class="logo-footer">
                                        <img src="{{ asset('images/logo.svg') }}" alt="" />
                                    </div>
                                    <div class="about-caption">
                                        {{ trans('frontend.homepage.footer.about_caption') }}
                                    </div>
                                    <div class="about-contact">
                                        <div class="item">
                                            <span class="cs-icon icon-marker"></span>
                                            <address>{{ trans('frontend.homepage.footer.address') }}</address>
                                        </div>
                                        <div class="item">
                                            <span class="cs-icon icon-phone"></span>
                                            <a href="tel:{{ trans('frontend.homepage.footer.phone') }}">{{ trans('frontend.homepage.footer.phone') }}</a>
                                        </div>
                                        <div class="item">
                                            <span class="cs-icon icon-mail"></span>
                                            <a href="mailto:{{ trans('frontend.homepage.footer.email') }}">{{ trans('frontend.homepage.footer.email') }}</a>
                                        </div>
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
                    <div class="footer_copyright">
                        Copyright &copy; {{ date('Y') }}
                        <a href="/" title="Cantinapp">Cantinapp</a>.
                        All Rights Reserved |
                        <a href="{{ asset('downloadable/CantinappTermsOfUse and PrivacyNotice.pdf') }}" target="_blank" title="{{ trans('frontend.homepage.footer.terms_and_conditions') }}">
                            {{ trans('frontend.homepage.footer.terms_and_conditions') }}
                        </a>.
                    </div>
                </div>
            </div>
        </section>
    </div>
</footer>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136825704-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-136825704-1');
</script>

<script src="{{ route('assets.lang') }}"></script>
<script type="text/javascript" src="{{ mix('dist/frontend/js/app.js') }}"></script>
@yield('javascript')

</body>
