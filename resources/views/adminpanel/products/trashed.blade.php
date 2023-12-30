@extends("adminpanel.layouts.panel-layout")
@section("title","Trashed Categories")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Trashed Categories</li>
@endsection
@section("content")

    <x-alret type="success"/>
    <hr>
    <h4>Total Categories: {{$category_number}}</h4>
{{--    <div class="mb-5">--}}
{{--        <a href="{{route("categories.create")}}" class="btn btn-sm btn-outline-primary">Create Category</a>--}}
{{--    </div>--}}

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
            <th>Status</th>
            <th>Deleted At</th>
            <th>Restore</th>
            <th>Force Delete</th>
        </tr>
        </thead>
        <tbody>
        @forelse($category as $cat)
            <tr>
                @if($cat->image)
                    <td><img src="{{asset("storage/".$cat->image)}}" height="50px"></td>
                @else
                    <td>No Image</td>
                @endif

                <td>{{$cat->id}}</td>
                <td>{{$cat->name}}</td>
                <td>{{$cat->status}}</td>
                <td>{{$cat->deleted_at}}</td>
{{--                <td><a href="{{route("categories.edit",$cat->id)}}" class="btn btn-sm btn-outline-success" role="button">Edit</a> </td>--}}

                    <td><form action="{{route("categories.restore",$cat->id)}}" method="post">
                            @method("put")
                            @csrf
                            <button class="btn btn-sm btn-outline-info" type="submit">Restore</button>
                        </form></td>

                <td><form action="{{route("categories.force-delete",$cat->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                        <button class="btn btn-sm btn-outline-danger" type="submit">Force Delete</button>
                    </form></td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Categories Yet</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div>
        {{$category->withQueryString()->links()}}
    </div>

@endsection

