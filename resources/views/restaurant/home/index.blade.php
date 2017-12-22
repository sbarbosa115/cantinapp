@extends('restaurant.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <a class="card-footer text-white clearfix small z-1" href="{{ route("restaurant.create") }}" id="create-item">
                            <span class="float-left">Create new product</span>
                            <span class="float-right">
                            <i class="fa fa-product-hunt"></i>
                          </span>
                        </a>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist" id="options-tab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#products" role="tab">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#queue" role="tab">Queue</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="products" role="tabpanel">
                    Este es un contenido de prueba cargado a la tab.
                </div>
                <div class="tab-pane" id="queue" role="tabpanel">b</div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
    <div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        sdfs65656
    </div>
@endsection('content')

@section('javascript')
    <script>

    </script>
@endsection('javascript')