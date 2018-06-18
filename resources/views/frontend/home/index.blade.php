@extends('frontend.base')

@section('body_class', 'index-template')

@section('content')

    @include('frontend.partials._flash')

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

    <section class="home-product-layout" id="root">

    </section>



@endsection

@section('javascript')

@endsection