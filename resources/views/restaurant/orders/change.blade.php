<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <p class="text-center" style="font-size: 22px">Do you want to change the status of this order?</p>

            <br />
            <br />

            <form action="{{ route("restaurant.orders.status", ["id" => $order->id]) }}" method="post" style="display: inline;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="{{ $status }}">
                @if($order->status !== "delivered")
                    <button type="submit" class="btn btn-danger">Change to {{ $status }}</button>
                @endif
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

    </div>
</div>