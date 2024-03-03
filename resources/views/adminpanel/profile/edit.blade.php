@extends("adminpanel.layouts.panel-layout")
@section("title","Edit Profile")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section("content")
    <form action="{{route("dashboard.update.profile")}}" method="post" enctype="multipart/form-data">
        @method("patch")
        @csrf
        <div class="form-group">
            <x-form.input label="First Name" name="firstName"  value="{{$user->profile->firstName}}" />

        </div>

        <div class="form-group">
            <x-form.input label="Last Name" name="lastName"  value="{{$user->profile->lastName}}" />
        </div>

        <div class="form-group">
            <x-form.input label="Birhtday"
             type="date" name="birthday" value="{{$user->profile->birthday}}" />
             @error("birthday")
                <div class="text-danger ">
                 {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">Gender</label>
            <x-form.radio name="gender" value="Male" status="{{$user->profile->gender}}" />
            <x-form.radio name="gender" value="Female" status="{{$user->profile->gender}}" />
        </div>

        <div class="form-group">
            <x-form.input label="Street" name="street"  value="{{$user->profile->street}}" />
        </div>

        <div class="form-group">
            <x-form.input label="City" name="city"  value="{{$user->profile->city}}" />
                @error("city")
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
        </div>

        <div class="form-group">
            <x-form.input label="Postal Code" type="number" name="postalCode"  value="{{$user->profile->postalCode}}" />
        </div>


        <div class="form-group">
                <label for="country">country</label>
        <select name="country" class="form-control form-select">
        <option value="">Country</option>
            @foreach($countries as $value => $text)
                <option value="{{ $value }}" @selected($value == $user->profile->country) >{{ $text }}</option>
            @endforeach
        </select>
        @error("country")
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
        </select>
        </div>

        <div class="form-group">
        <label for="language">Language</label>
             <select name="language" class="form-control form-select">
              <option value="">Language</option>
               @foreach($language as $value=>$text)
                  <option value="{{ $value }}" @selected($value == $user->profile->language)>{{ $text }}</option>
               @endforeach
             </select>
    @error("language")
    <div class="text-danger ">
        {{$message}}
    </div>
    @enderror
    </select>
    </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection
