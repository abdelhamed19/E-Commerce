@extends("adminpanel.layouts.panel-layout")
@section("title",$category->name)
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection
@section("content")
<table class="table">
    <thead>
    <tr>
        <th>Products</th>
        <td>Store</td>
        <th>Status</th>
        <th>Created At</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>
        @forelse($category->products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>{{$product->created_at}}</td>
                <td><a href="{{route("products.edit",$product->id)}}" class="btn btn-sm btn-outline-success" role="button">Edit</a> </td>
                <td><form action="{{route("products.destroy",$product->id)}}" method="post">
                    @method("DELETE")
                    @csrf
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form></td>
            </tr>
        @empty
        <tr>
            <td colspan="5">No Products Yet</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
