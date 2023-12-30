@props([
    "name","value","type"=>"radio","status"
])
<div class="form-check">
    <input class="form-check-input" type="{{$type}}" name="{{$name}}" id="exampleRadios1" value="{{$value}}" @checked($status == $value)>
    <label class="form-check-label" for="exampleRadios1">
        {{$value}}
    </label>
</div>
