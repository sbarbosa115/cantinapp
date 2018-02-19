@extends('frontend.base')

@section('body_class', 'index-template')

@section('content')

    <div class="shopify-section index-section index-section-welcome">
        <section class="home-welcome-layout zoomIn animated" data-animate="zoomIn" data-delay="200">
            <div class="container">
                <div class="row">
                    <div class="home-welcome-inner">
                        <h2 class="page-title">Welcome to Yummy!</h2>
                        <div class="home-welcome-content">
                            <span class="welcome-caption">
                                Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem.
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce feugiat malesuada odio.
                            </span>
                            <img class="welcome-banner" src="https://cdn.shopify.com/s/files/1/2487/3424/files/1_3e7313a2-24ef-4dea-b4f4-19a75f8b51fa.png" alt="" title="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="shopify-section index-section index-section-product">
        <section class="home-product-layout">
            @foreach($categories as $category)
            <div class="container">
                <div class="row">

                    <div class="banner-product-title fadeInUp animated" data-animate="fadeInUp" data-delay="200" style="background-image:  url(http://via.placeholder.com/1170x182);">
                        <div class="title-content">
                            <h2>{{ $category->name }}</h2>
                        </div>
                    </div>

                    <div class="home-product-inner">
                        <div class="home-product-content">
                            @foreach($category->products()->get() as $product)
                                <div class="content_product col-sm-3 fadeInUp animated" data-animate="fadeInUp" data-delay="100">
                                <div class="row-container product list-unstyled clearfix product-circle">
                                    <div class="row-left">
                                        <a href="./product.html" class="hoverBorder container_item">
                                            <div class="hoverBorderWrapper">
                                                <img src="{{ asset($product->image_path) }}" class="img-responsive front" alt="{{$product->name}}">
                                                <div class="mask"></div>
                                            </div>
                                        </a>
                                        <div class="hover-mask">
                                            <div class="group-mask">
                                                <div class="inner-mask">
                                                    <div class="group-actionbutton">
                                                        <ul class="quickview-wishlist-wrapper">
                                                            <li class="wishlist">
                                                                <a title="Add To Wishlist" class="wishlist wishlist-juice-ice-tea" data-wishlisthandle="juice-ice-tea"><span class="cs-icon icon-heart"></span></a>
                                                            </li>
                                                            <li class="quickview hidden-xs hidden-sm">
                                                                <div class="product-ajax-cart">
                                                                    <span class="overlay_mask"></span>
                                                                    <div data-handle="juice-ice-tea" data-target="#quick-shop-modal" class="quick_shop" data-toggle="modal">
                                                                        <a class=""><span class="cs-icon icon-eye"></span></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="compare">
                                                                <a title="Add To Compare" class="compare compare-juice-ice-tea" data-comparehandle="juice-ice-tea"><span class="cs-icon icon-retweet2"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <form action="./cart.html" method="post">
                                                        <div class="effect-ajax-cart">
                                                            <input name="quantity" value="1" type="hidden">
                                                            <button class="_btn add-to-cart" data-parent=".parent-fly" type="submit" name="add" title="Add To Order">Add to Order</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--inner-mask-->
                                            </div>
                                            <!--Group mask-->
                                        </div>
                                        <div class="product-label">
                                            <div class="label-element new-label">
                                                <span>New</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-right animMix">
                                        <div class="rating-star">
                                            <span class="spr-badge" data-rating="0.0">
                                                <span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i>
                                                    <i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>
                                                    <i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>
                                                </span>
                                                <span class="spr-badge-caption">No reviews</span>
                                            </span>
                                        </div>
                                        <div class="product-title">
                                            <a class="title-5" href="./product.html">{{ $product->name }}</a>
                                        </div>
                                        <div class="product-price">
                                            <span class="price">
                                                <span class="money" data-currency-usd="{{ $product->getCurrency() }}">{{ $product->getCurrency() }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </div>

@endsection()