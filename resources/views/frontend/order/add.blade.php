<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add product to current order</h5>
        </div>
        <div class="modal-body">
            <form id="add-to-order">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="dish">Dish</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                        @if($errors->first('product_id'))
                            <div>{{$errors->first('product_id')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dish-quantity">Quantity</label>
                        <select name="quantity" class="form-control" id="dish-quantity-select">
                            <option value="1" selected>1 dish</option>
                            <option value="2">2 dishes</option>
                            <option value="3">3 dishes</option>
                            <option value="4">4 dishes</option>
                            <option value="5">5 dishes</option>
                        </select>
                        <input type="hidden" value="{{ $product->id }}" name="product_id"/>

                        @if($errors->first('quantity'))
                            <div>{{$errors->first('quantity')}}</div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12 tabs-sides" id="sides-container">
                </div>

            </form>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="add-product-to-order">Add</button>
            @if(Session::has('order'))
                <a href="{{ route('frontend.order.show') }}" class="btn btn-primary">Make Order</a>
            @endif
        </div>
    </div>
</div>

<script>
    const productSides = JSON.parse('{!! \App\Repositories\ProductRepository::getAllProductsBySideGrouped()->toJson() !!}');

    $(document).off("click", "#add-product-to-order").on("click", "#add-product-to-order", function (e) {
        e.preventDefault();
        $.post("{{ route("frontend.order.add.product") }}", $("#add-to-order").serialize(), function (data) {
            $("#modal-messages").html(data);
        });
    });

    renderSidesTabs = (quantity) => {
        let tabsContainer = ['<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">'];
        let contentContainer = ['<div class="tab-content">'];

        for(let i = 1; i <= quantity; i++){
            tabsContainer.push([`<li><a href="#product-${i}" data-toggle="tab">Dish ${i} Sides</a></li>`])
            contentContainer.push([`<div class="tab-pane" id="product-${i}"> <br />`]);

            Object.keys(productSides).forEach((items) => {
                contentContainer.push([`<div class="form-group col-md-12">
                    <label for="dish-quantity">Dish ${i} ${items} side</label>
                    <select name="side[${i}][]" class="form-control">
                    <option value="" selected>Select Side</option>`]);

                let _item = [];
                Object.keys(productSides[items]).forEach((item, index) => {
                    _item.push([`<option value="${productSides[items][index].id}" selected>${productSides[items][index].name}</option>`]);
                });

                contentContainer.push([_item.join('')]);
                contentContainer.push([`</select></div>`]);
            })

            contentContainer.push([`<div class="form-group col-md-12">
                    <label for="inputCity">Do you have a special requirement in this Order?</label>
                    <textarea class="form-control" name="comment[${i}]"></textarea>
                </div>`
            ]);
            contentContainer.push([`<br /></div>`]);
        }
        tabsContainer.push(['</ul>']);
        contentContainer.push(['</div>']);
        $('#sides-container').html(tabsContainer.join('')).append(contentContainer.join(''));
        $('#sides-container a:first').tab('show');
    }

    $(document).off("change", "#dish-quantity-select").on("change", "#dish-quantity-select", function (e) {
        e.preventDefault();
        renderSidesTabs($(this).val())
    });

    $(document).ready(function() {
        @if ($message = Session::get('success'))
        $("#modal-messages").modal('hide');
        window.location.reload();
        @endif

        renderSidesTabs($("#dish-quantity-select").val());
    });


</script>