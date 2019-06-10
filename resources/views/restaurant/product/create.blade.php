@extends('restaurant.partials._form_uploads')

@section('enctype', 'enctype="multipart/form-data"')

@section('form')
<div class="form-group">
    <label for="recipient-name" class="form-control-label">Name:</label>
    <input type="text" class="form-control" name="name" placeholder="Place here the name of the product" value="{{ old('name', $product->name) }}">
    @if($errors->first('name'))
        <div class="form-control-feedback">{{$errors->first('name')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="message-text" class="form-control-label">Price:</label>
    <input type="number" step="any" class="form-control" name="price" placeholder="Place here your's product price" value="{{ old('price', $product->price) }}">
    @if($errors->first('price'))
        <div class="form-control-feedback">{{$errors->first('price')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="message-text" class="form-control-label">Description:</label>
    <textarea class="form-control" name="description" placeholder="Place here the better description about your product">{{ old('description', $product->description) }}</textarea>
    @if($errors->first('description'))
        <div class="form-control-feedback">{{$errors->first('description')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="message-text" class="form-control-label">Type:</label>
    <select class="form-control" name="type">
        <option value="">Choose a category to this product.</option>
        <option value="{{\App\Model\Product\Side::TYPE_SIDE}}" @if(old('type', $product->type) === \App\Model\Product\Side::TYPE_SIDE) selected @endif>
            Side
        </option>
        <option value="{{\App\Model\Product\Meal::TYPE_MEAL}}" @if(old('type', $product->type) === \App\Model\Product\Meal::TYPE_MEAL) selected @endif>
            Meal
        </option>
    </select>
    @if($errors->first('type'))
        <div class="form-control-feedback">{{$errors->first('type')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="message-text" class="form-control-label">Picture:</label>
    <input type="file" class="form-control" name="image" placeholder="Load a image that show to the users the better side about your product">
    @if($errors->first('image'))
        <div class="form-control-feedback">{{$errors->first('image')}}</div>
    @endif
</div>

<div class="form-group">
    <div class="alert alert-danger  " role="alert">
        If you are adding a Side (using side category option) DO NOT FORGET ADD the  available sub category here -Juice or Meals-
    </div>
    <label for="message-text" class="form-control-label">Tags:</label>
    @if(old('tags'))
        <textarea name="tags" id="tags" placeholder="Put tags separated by ,">{{ implode(',', json_decode(old('tags'), true)) }}</textarea>
    @endif
    @if($product->tags())
        <textarea name="tags" id="tags" placeholder="Put tags separated by ,">{{ implode(', ', $product->tags()->get()->pluck('name')->toArray()) }}</textarea>
    @endif

    @if($errors->first('tags'))
        <div class="form-control-feedback">{{$errors->first('tags')}}</div>
    @endif
</div>

<div class="form-group">
    <a class="btn btn-info" href="{{ route('restaurant.product.index') }}">Go Back</a>
    <input type="submit" class="btn btn-success" value="Save Product">
</div>

@endsection('form')

@section('javascript')
    <script>
        const input = document.querySelector('textarea[name=tags]'),
        tagify = new Tagify(input);
    </script>
@endsection
