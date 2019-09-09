<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Cantinapp - The new way to get your Cantina!!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="{{ mix('dist/restaurant/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">
<!-- Navigation-->

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ route('restaurant.orders.index') }}">Cantinapp</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form
            class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"
            method="POST"
            action="{{ route('restaurant.account.handle.allow.order') }}"
    >
        @csrf

        @if(\Illuminate\Support\Facades\Auth::guard('employee')->user()->restaurant->allow_orders === true)
            <button type="submit" class="btn btn-success">Click to Disable</button>
        @else
            <button type="submit" class="btn btn-danger">Click to Enable</button>
        @endif
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> Welcome, {{ \Illuminate\Support\Facades\Auth::guard('employee')->user()->email }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('restaurant.logout') }}">Logout</a>
            </div>
        </li>
    </ul>
</nav>


<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('restaurant.product.index') }}">
                <i class="fas fa-fw fa-store"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('restaurant.orders.index') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('restaurant.employee.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Employees</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('restaurant.balance.index') }}">
                <i class="fas fa-fw fa-money-bill"></i>
                <span>Balance</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('restaurant.account.index') }}">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>My Account</span>
            </a>
        </li>
    </ul>

    <div id="content-wrapper">
        @yield('content')
    </div>

    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <small>Copyright © Cantinapp 2018</small>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <script src="{{ mix('dist/restaurant/js/app.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136825704-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-136825704-1');
    </script>

@yield('javascript')
</body>
</html>
