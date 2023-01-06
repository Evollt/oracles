@extends('layout.base')

@section('page')
    <div class="max-w-2xl mx-auto">
        @include('layout.partials.alerts')
        @yield('content')
    </div>
@endsection
