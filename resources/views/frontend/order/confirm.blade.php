<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add product to current order</h5>
        </div>
        <div class="modal-body">
            <form id="confirm-pickup">



                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="datetimepicker12"></div>
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
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true
        });
    });
    $(document).off("click", "#confirm-and-proceed").on("click", "#confirm-and-proceed", function (e) {
        e.preventDefault();

        $("#confirm-pickup").submit();
    });

</script>