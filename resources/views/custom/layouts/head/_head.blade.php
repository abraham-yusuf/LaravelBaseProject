<head>
    @include('custom.layouts.head._meta')
    <title>
        @if($title != null)
            {{$title}} - {{config('custom.web.title')}}
        @else
            {{config('custom.web.title')}}
        @endif
    </title>
    @include('custom.layouts.head._styles')
</head>
