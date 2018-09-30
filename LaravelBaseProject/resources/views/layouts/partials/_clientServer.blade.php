@section('clientServer')
    @if (config('app.env') == 'production')
        <div id="wdata"
             data-lj="{{ config('clientServer.lazyJSMinPath') }}?{{ config('hash.styles') }}"
             style="display: none;"></div>
    @else
        <div id="wdata" data-lj="{{ config('clientServer.lazyJSPath') }}" style="display: none;"></div>
    @endif
@show