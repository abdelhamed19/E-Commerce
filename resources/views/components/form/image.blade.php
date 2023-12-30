@props([
    "label","name","value","type"
])
<label for="image">{{$label}}</label>
<input type="{{$type}}" name="{{$name}}" class="form-control">
@if($value)
    <td><img src="{{asset("storage/".$value)}}" height="50px"></td>
@else
    <td>No Image</td>
@endif
