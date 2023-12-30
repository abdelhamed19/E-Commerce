<div class="form-group">
    <x-form.input label="Categorey's Name"
     type="text" name="name"  value="{{$category->name}}" />
</div>

<div class="form-group">
    <label for="categoryParent">Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parent as $par)
            <option value="{{$par->id}}" @selected($category->parant_id == $par->id)>{{$par->name}}</option>
        @endforeach
    </select>
    @error("parent_id")
    <div class="text-danger ">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <x-form.textarea name="description" label="Description" value="{{$category->description}}"/>
</div>

<div class="form-group">
    <x-form.image label="Logo" name="image" type="file" value="{{$category->image}}" />
</div>

<div class="form-group">
    <label for="logo">Status</label>
    <x-form.radio name="status" type="radio" value="active" status="{{$category->status}}" />
    <x-form.radio name="status" type="radio" value="inactive" status="{{$category->status}}" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$btn}}</button>
</div>
