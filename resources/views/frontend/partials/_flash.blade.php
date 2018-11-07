@if ($message = Session::get('success'))
    <section class="heading-content">
        <div class="heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($message = Session::get('error'))
    <section class="heading-content">
        <div class="heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($message = Session::get('warning'))
    <section class="heading-content">
        <div class="heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($message = Session::get('info'))
    <section class="heading-content">
        <div class="heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($errors->any())
    <section class="heading-content">
        <div class="heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @foreach($errors->getMessages() as $key => $message)
                            {{ $message[0] }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif