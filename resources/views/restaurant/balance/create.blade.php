 <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Recharge balance for: <strong>{{ $user->name }}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5>Current Balance: {{ $user->balances()->count() }}</h5>
            <form method="post" action="{{ route('restaurant.balance.store') }}">
                {!! csrf_field() !!}
                @include('restaurant.balance._form')
            </form>
        </div>
    </div>
</div>
