@if (config('app.env') == 'production')
    <div id="cl-srv"
         class="none"
         data-lj="{{ hashed('/js/lazy.js') }}">
    </div>
@else
    <div id="cl-srv"
         class="none"
         data-lj="{{ hashed('/js/lazy.min.js') }}">
    </div>
@endif