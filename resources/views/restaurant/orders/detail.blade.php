<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer: <strong>{{ $order->user->name }}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Dish</th>
                    <th>Customer Comment</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($order->products()->get() as $product)
                        <tr>
                            <td class="text-center">{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->name  }}</td>
                            <td>{{ $product->pivot->comment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>