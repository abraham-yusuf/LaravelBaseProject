@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ url('/home') }}">Auth Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
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