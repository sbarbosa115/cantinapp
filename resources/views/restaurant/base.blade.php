<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Cantinapp - The new way to get your Cantina!!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="{{ asset("dist/restaurant/css/app.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="View Products">
                <a class="nav-link" href="{{ route("restaurant.product.index") }}">
                    <i class="fa fa-fw fa-shopping-basket"></i>
                    <span class="nav-link-text">Products</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="View Orders">
                <a class="nav-link" href="{{ route("restaurant.orders.index") }}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">Orders</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="View Employees">
                <a class="nav-link" href="{{ route("restaurant.employee.index") }}">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Employee</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="View Orders">
                <a class="nav-link" href="{{ route("restaurant.balance.index") }}">
                    <i class="fa fa-fw fa-money"></i>
                    <span class="nav-link-text">Recharge</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"  href="{{ route("restaurant.logout") }}">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
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
            <small>Copyright © Cantinapp 2018</small>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<script src="{{ asset("dist/restaurant/js/app.js") }}"></script>

@yield('javascript')
</body>
</html>
