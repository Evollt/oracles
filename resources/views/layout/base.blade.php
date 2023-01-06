@extends('layout.html')

@section('html')
        <x-navigation.navigation/>

        <div id="layoutSidenav">
            <x-navigation.side-navigation/>
            <div id="layoutSidenav_content">
                <main>
                    @yield('top')
                    @yield('page')
                </main>
                <x-footer/>
            </div>
        </div>
@endsection
