@extends("adminpanel.layouts.panel-layout")
@section("title","Create Category")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section("content")
    <form action="{{route("categories.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        @include("adminpanel.categories._form",["btn"=>"Create"])
    </form>
@endsection
