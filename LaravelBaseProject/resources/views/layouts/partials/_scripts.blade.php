<script src="{{ hashed('/js/vendors.min.js') }}" defer></script>
@if (config('app.env') == 'production')
    <script src="{{ hashed('/js/app.js') }}" defer></script>
@else
    <script src="{{ hashed('/js/app.min.js') }}" defer></script>
@endif