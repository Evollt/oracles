<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('images/Favicon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('images/Favicon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('images/Favicon.png') }}">
        <link rel="manifest" href="{{ URL::asset('favicon/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">
        {{-- <script src="https://kit.fontawesome.com/73fa916b72.js" crossorigin="anonymous"></script> --}}
    </head>
    <body class="nav-fixed bg-gray-800">
        <div id="layoutEmailVerification_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 mt-5 mb-5">
                            @include('layout.partials.alerts')
                            @component('components.card')
                                @slot('title')
                                    Clarity DAO @if(null !== auth()->user()->security->phishing_code) <p>Anti phising code: {{ auth()->user()->security->phishing_code }}</p> @endif
                                @endslot
                                <p>Please enter the code below to verify your email address</p>

                                <div class="mt-4 mb-4">
                                    <span style="font-size: 32" class="badge bg-primary">{{ $user->verification_code }}</span>
                                </div>
                            @endcomponent
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutEmailVerification_footer">
            <x-footer/>
        </div>

    </body>
</html>
