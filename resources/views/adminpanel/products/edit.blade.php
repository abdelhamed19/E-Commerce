@extends("adminpanel.layouts.panel-layout")
@section("title","Edit Category")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Product</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection
@section("content")
    <form action="{{route("products.update",$product->id)}}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @csrf
        @include("adminpanel.products._form",["btn"=>"Update"])
    </form>
@endsection
