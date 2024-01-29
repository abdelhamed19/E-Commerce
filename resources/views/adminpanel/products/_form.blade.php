<div class="form-group">
    <x-form.input label="Product's Name"
     type="text" name="name"  value="{{$product->name}}" />
</div>


<div class="form-group">
    <x-form.textarea name="description" label="Description" value="{{$product->description}}"/>
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
        @foreach ($categories as $categories )
        <option value="{{$categories->id }}">{{$categories->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <x-form.image label="Logo" name="image" type="file" value="{{$product->image}}" />
</div>

<div class="form-group">
    <x-form.input label="Price"
     type="number" name="price"  value="{{$product->price}}" />
</div>

<div class="form-group">
    <x-form.input label="Compare Price"
     type="number" name="Compare_Price"  value="{{$product->Compare_Price}}" />
</div>
<div class="form-group">
    <x-form.input label="Product's Tags"
     type="text" name="tags" value="{{ $tags  ?? '' }} " />
</div>

<div class="form-group">
    <label for="logo">Status</label>
    <x-form.radio name="status" type="radio" value="active" status="{{$product->status}}" />
    <x-form.radio name="status" type="radio" value="draft" status="{{$product->status}}" />
    <x-form.radio name="status" type="radio" value="archvied" status="{{$product->status}}" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$btn}}</button>
</div>


<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>

