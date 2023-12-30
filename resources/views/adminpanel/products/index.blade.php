@extends("adminpanel.layouts.panel-layout")
@section("title","Products")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection
@section("content")

<x-alret type="success"/>

    <hr>
    <h4>Total Products: {{$allproducts->count()}}</h4>
    <div class="mb-5">
        <a href="{{route("products.create")}}" class="btn btn-sm btn-outline-primary">Create Product</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Trashed Product</a>
    </div>

<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" value="{{request('name')}}" class="mx-2"/>
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request("status") == "active ")>Active</option>
        <option value="inactive" @selected(request("status") == "inactive ")>Inactive</option>
    </select>
    <button type="submit" class="btn btn-dark">Filter</button>
</form>

<table class="table">
    <thead>
    <tr>
        <th>Photo</th>
        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>Store</th>
        <th>Created At</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                @if($product->image)
                    <td><img src="{{asset("storage/".$product->image)}}" height="50px"></td>
                @else
                    <td>No Image</td>
                @endif

                <td>{{$product->id}}</td>
                <td> <a href="{{ route("products.show",$product->id) }}">
                    {{$product->name}}
                    </a>
                </td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->status}}</td>
                <td><a href="{{route("products.edit",$product->id)}}" class="btn btn-sm btn-outline-success" role="button">Edit</a> </td>

                <td><form action="{{route("products.destroy",$product->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                    </form></td>
            </tr>
        @empty
        <tr>
            <td colspan="7">No Products Yet</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div>
    {{$products->withQueryString()->links()}}
</div>


@endsection


{{--@if($category->count() !=0)--}}
{{--    @foreach($category as $cat)--}}
{{--        <tr>--}}
{{--            <td>{{$cat->id}}</td>--}}
{{--            <td>{{$cat->name}}</td>--}}
{{--            <td>{{$cat->parent_id}}</td>--}}
{{--            <td>{{$cat->created_at}}</td>--}}
{{--            <td><a href="{{route("categories.edit",$cat->id)}}" class="btn btn-sm btn-outline-success" role="button">Edit</a> </td>--}}

{{--            <td><form action="{{route("categories.destroy",$cat->id)}}" method="post">--}}
{{--                    @method("DELETE")--}}
{{--                    @csrf--}}
{{--                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>--}}
{{--                </form></td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    <tr>--}}
{{--        <td colspan="7">No Categories Yet</td>--}}
{{--    </tr>--}}
{{--@endif--}}
