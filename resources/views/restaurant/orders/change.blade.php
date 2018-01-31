<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h1>Really, Do you want to change the status of this order?</h1>
        </div>
        <div class="modal-footer">

            <form action="{{ route("restaurant.orders.status", ["id" => $order->id]) }}" method="post" style="display: inline;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="{{ $status }}">
                @if($order->status === "created")
                    <button type="submit" class="btn btn-danger">Change to {{ $status }}</button>
                @elseif($order->status === "cooking")
                    <button type="submit" class="btn btn-success">Change to delivered</button>
                @endif
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>