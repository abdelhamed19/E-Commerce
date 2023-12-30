@extends("adminpanel.layouts.panel-layout")
@section("title",$product->name)
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection
@section("content")
<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Compare Price</th>
        <th>Feature</th>
        <th>Rating</th>
    </tr>
    </thead>
    <tbody>
        @if($product->count() != 0)
            
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->Compare_Price}}</td>
                <td>{{$product->feature}}</td>
                <td>{{$product->rating}}</td>
            </tr>
            @else
        <tr>
            <td colspan="5">No Products Yet</td>
        </tr>
@endif
    </tbody>
</table>
@endsection
