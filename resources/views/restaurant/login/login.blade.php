@extends('restaurant.simple')

@section('content')

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input class="form-control" placeholder="Username" type="text" name="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" placeholder="Password" type="password" name="">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox"> Remember Password</label>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-block" value="Login" type="submit">
                </form>
            </div>
        </div>
    </div>

@endsection('content')

@section('javascript')
    <script>
        $(document).ready( function () {

            $('.nav-tabs a').click(function(e){
                var _option = $(e.currentTarget).html();
                if(_option === "Products"){
                    $('#entities').DataTable();
                    console.log("Opening datatables");
                }0
                $(this).tab('show');
            })

        });


    </script>
@endsection('javascript')