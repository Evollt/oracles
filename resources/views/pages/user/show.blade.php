@extends('layout.templates.container', ['useHeader' => false])

@section('content')
    <div class="row ">
        <div class="col-lg-12">
            <h1 class="page-header-title text-white mt-4 mb-3">User information</h1>
            <div class="row">
                <div class="col-lg-4">
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
                            <x-setting.status color="{{ $user->roles->first() ? $user->roles()->first()->color->id : 'info' }}" title="{{ $user->roles->first() ? $user->roles->first()->name : 'Has no role!' }}"/>
                        @endslot
                        <p>
                            <strong>Discord:</strong><br>
                            {{ $user->username }}#{{ $user->discriminator }}
                        </p>
                        <p>
                            <strong>Email:</strong><br>
                            @if (null !== $user->email_verified_at)
                            {{ $user->email }} <x-setting.status color="success" title="✓ Verified"/>
                        @else
                            {{ $user->email ?? '-' }}
                        @endif
                        </p>
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
