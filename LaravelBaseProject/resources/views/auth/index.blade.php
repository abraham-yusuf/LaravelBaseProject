@extends('layouts.app')

@include('partials._page-title', ['pageTitle' => __('pages.auth')])

@section('content')
    <div class="title m-b-md">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

       Auth Dashboard!
    </div>
@endsection



