<div class="form-group">
    <label for="recipient-name" class="form-control-label">Quantity:</label>
    <input type="number" class="form-control" name="quantity" placeholder="Place the quantity " value="{{ old('quantity') }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    @if($errors->first('quantity'))
        <div class="form-control-feedback">{{$errors->first('quantity')}}</div>
    @endif
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success" value="Add Balance">
</div>