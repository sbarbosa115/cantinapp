@extends('restaurant.base')


@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
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
@endsection('content')

@section('javascript')
    <script>

    </script>
@endsection('javascript')