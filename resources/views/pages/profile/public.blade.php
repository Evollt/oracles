@extends('layout.templates.container', ['useHeader' => true])

@section('header')
    <h1 class="page-header-title">
        <div class="page-header-icon"><i class="fas fa-user"></i></div>
        Profile - {{ $user->alias }}
    </h1>
@endsection

@section('content')
    <div class="row ">
        <div class="col-lg-12">
            <a href="{{ url()->previous() }}" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
            <div class="row">
                <div class="col-lg-2">
                    @component('components.card', ['extraBodyClasses' => 'text-center'])
                        @slot('title')
                            Profile picture
                        @endslot

                            <img class="img-account-profile rounded-circle" src="{{ $user->profile_image }}" alt="">
                    @endcomponent
                </div>
                <div class="col-lg-8">
                    @component('components.card')
                        @slot('title')
                            Information
                        @endslot
                        <p>
                            <strong>Name (alias):</strong><br>
                            {{ $user->alias }}
                        </p>
                        <p>
                            <strong>Wallets:</strong><br>
                            @foreach ($user->wallets as $wallet)
                                {{ $wallet->address }} <br>
                            @endforeach
                        </p>
                    @endcomponent
                </div>
            </div>

            <hr class="mt-4 mb-4" />

            <h2 class="page-header-title text-white">Nfts owned by {{ $user->alias }}</h2>

            <div class="row mb-4">
                <x-user.nfts user="{{ $user->id }}" column="2" />
            </div>
        </div>
    </div>
@endsection
