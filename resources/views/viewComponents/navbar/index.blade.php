@if (Route::has('login'))
<div class="navbar">
    @foreach($model->pageLinks as $pageLink)
        <a href="{{$pageLink->url}}" class="{{ $pageLink->isActive ? 'active' : "" }}">{{$pageLink->text}}</a>
    @endforeach

    @if ($model->isUserAuth)
            <a href="{{$model->loginPageLink->url}}" class="dropdown-toggle" data-toggle="dropdown">
                {{ $model->userName }}
            </a>

    @else
        @foreach($model->userPageLinks as $userPageLink)
            <a href="{{$userPageLink->url}}" class="{{ $userPageLink->isActive ? 'active' : "" }}">{{$userPageLink->text}}</a>
        @endforeach
    @endif

    @if ($model->isMultilanguageActive)
        <div class="dropdown">
            <button class="dropbtn">
                {{ $model->currentLanguage }}
                <i class="la la-caret-down"></i>
            </button>
            <div class="dropdown-content">
                @foreach ($model->languageLinks as $languageLink)
                <a href="{{ $languageLink->url }}">
                    {{ $languageLink->text }}
                </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endif
