<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ hashed('css/vendors.min.css') }}" rel="stylesheet">
    <link href="{{ hashed('css/app.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ app()->getLocale() }}
            </a>
            <ul class="dropdown-menu">
                @foreach (config('translatable.locales') as $lang => $language)
                    @if ($lang != app()->getLocale())
                        <li>
                            <a href="{{ route('lang.switch', $lang) }}">
                                {{ $language }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
<script src="{{ hashed('js/vendors.min.js') }}" defer></script>
@if (config('app.env') == 'production')
    <script src="{{ hashed('js/app.js') }}" defer></script>
@else
    <script src="{{ hashed('js/app.min.js') }}" defer></script>
@endif
</body>
</html>
