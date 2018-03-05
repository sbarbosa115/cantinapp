<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add product to current order</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="pickup-recharge" style="display:none">
                This order will be processed but you need recharge your balance when you pick up this order.
            </div>

            <form id="confirm-pickup" method="post" action="{{ route("frontend.order.store") }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="payment-method">Payment Method</label>
                    <select class="form-control" name="payment_method" id="payment_method">
                        <option value="cash">Cash</option>
                        <option value="cantina">Cantina</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pick-up-time">When do you want to pick up your order?</label>
                    <div class="row">

                        <div class="col-md-8 col-md-offset-1">
                            <input type="hidden" class="datepicker" id="pick-at" data-date-format="YYYY-MM-DD HH:mm:ss" name="pickup_at">
                        </div>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="confirm-and-proceed" data-dismiss="modal">Confirm and Proceed</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#pick-at').datetimepicker({
            inline: true,
            sideBySide: true,
            minDate: moment().add(15, 'm')
        }).on("dp.change", function (e) {
            console.log(e.date)
        });
    });
    $(document).off("click", "#confirm-and-proceed").on("click", "#confirm-and-proceed", function (e) {
        e.preventDefault();
        $("#confirm-pickup").submit();
    });

    $(document).off("change", "#payment_method").on("change", "#payment_method", function (e) {
        e.preventDefault();

        if($(this).val() == 'cantina'){
            $.get("{{ route("frontend.order.check.balance", ["id" => Auth::user()->id]) }}", function(data){
                if(data.result == false){
                    $("#pickup-recharge").show();
                }
            })
        }
    });

</script>