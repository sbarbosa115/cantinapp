<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Candidatos a las elecciones de Colombia 2018</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Cantinapp</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Products">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-fw fa-shopping-basket"></i>
                    <span class="nav-link-text">Products</span>
                </a>
            </li>
        </ul>
    </div>
</nav>


@yield('content')

<!-- /.content-wrapper-->
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © Your Website 2017</small>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

@yield('javascript')
<script src="{{ asset("js/app.js") }}"></script>
</body>
</html>
