@extends("adminpanel.layouts.panel-layout")
@section("title","Create Product")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Product</li>
@endsection
@section("content")
    <form action="{{route("products.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        @include("adminpanel.products._form",["btn"=>"Create"])
    </form>
@endsection
