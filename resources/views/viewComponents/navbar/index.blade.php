@if (Route::has('login'))
<div class="navbar">
    @foreach($model->sectionslinks as $sectionLink)
        <a href="{{$sectionLink->url}}" class="{{ $sectionLink->isActive ? 'active' : "" }}">{{$sectionLink->text}}</a>
    @endforeach

    @if ($model->isUserAuth)
            <a href="{{$model->loginPageLink->url}}" class="dropdown-toggle" data-toggle="dropdown">
                {{ $model->userName }}
            </a>

    @else
        @foreach($model->sectionslinks as $sectionLink)
            <a href="{{$model->loginPageLink->url}}" class="{{ $model->loginPageLink->isActive ? 'active' : "" }}">{{$model->loginPageLink->text}}</a>
            <a href="{{$model->registerPageLink->url}}" class="{{ $model->registerPageLink->isActive ? 'active' : "" }}">{{$model->registerPageLink->text}}</a>
        @endforeach
    @endif

{{--    <div class="dropdown">--}}
{{--        <button class="dropbtn">--}}
{{--            {{ app()->getLocale() }}--}}
{{--            <i class="la la-caret-down"></i>--}}
{{--        </button>--}}
{{--        <div class="dropdown-content">--}}
{{--            @foreach (config('custom.languages.locales') as $lang => $language)--}}
{{--            @if ($lang != app()->getLocale())--}}
{{--            <a href="{{ route('lang.switch', $lang) }}">--}}
{{--                {{ $language }}--}}
{{--            </a>--}}
{{--            @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}


</div>
@endif
