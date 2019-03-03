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
    <label for="message-text" class="form-control-label">Category:</label>
    <select class="form-control" name="category">
        <option value="">Choose a category to this product.</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{ucfirst($category->name)}} ({{ucfirst($category->type)}})</option>
        @endforeach
    </select>
    @if($errors->first('category'))
        <div class="form-control-feedback">{{$errors->first('category')}}</div>
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
    <label for="message-text" class="form-control-label">Tags:</label>
    <textarea name="tags" id="tags" placeholder="Put tags separed by ,"></textarea>
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
        document.getElementById('tags').value = "{!! implode(', ', $product->tags()->get()->pluck('name')->toArray()) !!}";
        const input = document.querySelector('textarea[name=tags]'),
        tagify = new Tagify(input, {
            callbacks        : {
                add    : console.log,  // callback when adding a tag
                remove : console.log   // callback when removing a tag
            }
        });
    </script>
@endsection
