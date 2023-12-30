<label for="store">Store</label>
    <select name="store" class="form-control form-select">
        <option value="">{{ $product->store->name }}</option>
        @foreach ($stores as $stores )
        <option value="{{$stores->id }}">{{$stores->name }}</option>
        @endforeach
    </select>
    @error("store" )
    <div class="text-danger ">
        {{$message}}
    </div>
    @enderror