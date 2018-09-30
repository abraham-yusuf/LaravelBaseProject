<head>
    @include('layouts.partials.head._meta')
    <title>
        @if($title != null)
            {{$title}} - {{config('custom.web.title')}}
        @else
            {{config('custom.web.title')}}
        @endif

    </title>
    @include('layouts.partials.head._styles')
    @include('layouts.partials.head._old-browsers')
</head>