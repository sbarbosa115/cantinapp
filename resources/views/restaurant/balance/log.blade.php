<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer: <strong>{{ $user->name }}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5>Current Balance: {{ $user->balance()->count() }}</h5>
            <table class="table">
                @if($items->count())
                <thead>
                    <caption>Dishes taken</caption>
                    <tr>
                        <th>Dish</th>
                        <th>Date Created</th>
                        <th>Date Taken</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center">{{ $item->getProductAttribute("name") }}</td>
                            <td>{{ $item->created_at->toFormattedDateString() }}</td>
                            <td>{{ $item->updated_at->toFormattedDateString()  }}</td>
                        </tr>
                    @endforeach
                </tbody>
                @else
                    <h5>This user has not yet ordered.</h5>
                @endif
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>