@extends('layout.html')

@section('html')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-xl px-4">
                <div class="row justify-content-center">
                    <div class="col-lg-5 mt-5">
                        @include('layout.partials.alerts')
                        @component('components.card')
                            @slot('title')
                                Login
                            @endslot
                            <p>To login onto the platform please connect your Discord account</p>
                            <p>If you are not registered yet the platform will automatically create a account for you based of your Discord account</p>

                            <div class="mt-4 mb-0">
                                <a class="btn btn-primary" href="https://discord.com/oauth2/authorize?client_id={{env("DISCORD_CLIENT_ID")}}&redirect_uri={{env("DISCORD_REDIRECT_URI")}}&response_type=code&scope=identify%20email">
                                    Connect
                                </a>
                            </div>
                        @endcomponent
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <x-footer/>
    </div>
</div>
@endsection
