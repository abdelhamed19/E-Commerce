@extends("adminpanel.layouts.panel-layout")
@section("title","Edit Category")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Categories</li>
@endsection
@section("content")
    <form action="{{route("categories.update",$category->id)}}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @csrf
        @include("adminpanel.categories._form",["btn"=>"Update"])
    </form>
@endsection
