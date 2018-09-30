<head>
    @include('layouts.partials.head._meta')
    <title>
        @section('title')
            Titolo di fallback
        @show
    </title>
    @include('layouts.partials.head._styles')
    @include('layouts.partials.head._oldBrowsers')
</head>