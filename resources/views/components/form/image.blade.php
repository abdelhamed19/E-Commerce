@props([
    "label","name","value","type"
])
<label for="image">{{$label}}</label>
<input type="{{$type}}" name="{{$name}}" class="form-control">
<td>
    {!! $value ? '<img src="' . asset("storage/" . $value) . '" height="50px">' : 'No Image' !!}
</td>


{{-- @if($value)
    <td><img src="{{asset("storage/".$value)}}" height="50px"></td>
@else
    <td>No Image</td>
@endif --}}
