<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.partials.head._head')
<body>
@include('layouts.partials._clientServer')
<div class="flex-center position-ref full-height">

    @include('layouts.partials._navbar')

    <div class="content">
        @yield('content')
    </div>

</div>
@include('layouts.partials._scripts')
</body>
</html>
