
<div class="form-group">
    <x-form.input label="Product's Name"
     type="text" name="name"  value="{{$product->name}}" />
</div>


<div class="form-group">
    <x-form.textarea name="description" label="Description" value="{{$product->description}}"/>
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
    <label for="logo">Status</label>
    <x-form.radio name="status" type="radio" value="active" status="{{$product->status}}" />
    <x-form.radio name="status" type="radio" value="draft" status="{{$product->status}}" />
    <x-form.radio name="status" type="radio" value="archvied" status="{{$product->status}}" />
</div>

{{-- <div class="form-group">
    <label for="store">Store</label>
    <select name="store_id" class="form-control form-select">
        <option value="">{{ $product->store->name }}</option>
        <option value="{{$product->store->id }}">{{Auth::user()->store_id }}</option>
    </select>
</div> --}}

{{-- <div class="form-group">
@include("components.form.select")
</div> --}}

<div class="form-group">
    <label for="category">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">{{ $product->category->name }}</option>
        @foreach ($categories as $categories )
        <option value="{{$categories->id }}">{{$categories->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$btn}}</button>
</div>
