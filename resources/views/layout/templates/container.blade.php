@extends('layout.base')

@section('page')
    @if (!isset($useHeader) || true === $useHeader)
        <header class="page-header page-header-compact page-header-dark border-left border-bottom mb-4">
            <div class="container-fluid">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                @yield('header')
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endif
    <div class="container px-4">
        <div class="mt-4">
            @include('layout.partials.alerts')
        </div>
        @yield('content')
    </div>
@endsection
