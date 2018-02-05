@extends('restaurant.simple')

@section('content')

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('restaurant.login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class=" control-label">Identification Code</label>
                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>

                        <a class="btn btn-link" href="{{ route('restaurant.password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
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
                }
                $(this).tab('show');
            })
        });
    </script>
@endsection('javascript')