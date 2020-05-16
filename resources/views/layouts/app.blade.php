<!DOCTYPE html>
<html lang="{{ $model->currentLanguage->code}}">
@include('custom.layouts.head._head')

<body>
@include('custom.layouts._client-server')
@render(\App\Http\ViewComponents\Header\Components\HeaderComponent::class)

<div class="jpage wrapper" data-p="{{$model->id}}">
    @include('custom.form.messages.success')
    @include('layouts.partials._breadcrumbs', ['breadcrumbs' => $model->breadcrumbs])

    @yield('content')
</div>
@include('custom.layouts._scripts')
@include('custom.layouts._analytics')
</body>

</html>
