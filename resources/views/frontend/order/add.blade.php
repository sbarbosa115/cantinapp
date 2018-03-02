<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add product to current order</h5>
        </div>
        <div class="modal-body">
            <form id="add-to-order">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputCity">Dish</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Quantity</label>
                        <select name="quantity" class="form-control">
                            <option value="1" selected>1 dish</option>
                            <option value="2">2 dishes</option>
                            <option value="3">3 dishes</option>
                            <option value="4">4 dishes</option>
                            <option value="5">5 dishes</option>
                        </select>

                        <input type="hidden" value="{{ $product->id }}" name="product_id"/>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="add-product-to-order" data-dismiss="modal">Add</button>
            <a href="{{ route('frontend.order.get.product') }}" class="btn btn-primary">Make Order</a>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        @if ($message = Session::get('success'))
        $("#modal-messag").modal('hide');
        @endif
    });

    $(document).off("click", "#add-product-to-order").on("click", "#add-product-to-order", function (e) {
        e.preventDefault();

        $.post("{{ route("frontend.order.add.product") }}", $("#add-to-order").serialize(), function (data) {
            $("#modal-messages").html(data);
        });
    });

</script>