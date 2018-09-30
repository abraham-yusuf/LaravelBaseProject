@extends('layouts.app', ['title' => __('pages.auth')])

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



