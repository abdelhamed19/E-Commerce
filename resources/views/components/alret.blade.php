@if(session()->has($type))
    <div class="alert alert-success">
        {{session($type)}}
    </div>
@endif

{{--@if(session()->has("$type"))--}}
{{--    <div class="alert alert-info"></div>--}}
{{--    {{session("$type")}}--}}
{{--@endif--}}
