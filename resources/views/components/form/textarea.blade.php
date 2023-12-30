@props([
    "label","name","value"
])
<label for="description">{{$label}}</label>
<textarea name="{{$name}}"  class="form-control">{{old("$name",$value)}}</textarea>
@error($name)
<div class="text-danger ">
    {{$message}}
</div>
@enderror
