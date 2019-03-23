<div class="modal-dialog modal-lg" role="document">
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
                    <th>Sides</th>
                    <th>Coment</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($order->productsOrder()->get() as $productOrder)
                        <tr>
                            <td class="text-center">{{ $productOrder->quantity }}</td>
                            <td>{{ $productOrder->product->name }}</td>
                            <td>{{ $productOrder->sidesAsString() }}</td>
                            <td>{{ $productOrder->comment }}</td>
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
