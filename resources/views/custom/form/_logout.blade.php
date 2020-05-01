<form class="logout__form" action="{{ $url }}" method="POST">
    @csrf
    @method('POST')
    <button class="cro__button cro__button--basic"><i class="la la-sign-out" title="{{ $text }}"></i>{{ $text }}</button>
</form>
