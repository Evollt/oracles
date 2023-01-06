<!doctype html>
<html lang="en">
    <head>
        @include('layout.partials.head')
        @stack('css')
    </head>
    <body class="nav-fixed bg-gray-800">
        @yield('html')
        @include('layout.partials.footer')
        @stack('js')
        @yield('modal')
    </body>
</html>
