@extends('layout.templates.container', ['useHeader' => true])

@section('header')
    <h1 class="page-header-title">
        <div class="page-header-icon"><i class="fas fa-user"></i></div>
        Account - {{ $navName }}
    </h1>
@endsection

@section('content')
    @include('pages.profile.partials.tabs')

    <hr class="mt-0 mb-4" />
    {!! Form::open(['method' => 'POST', 'route' => ['user.account.profile.update'], 'errors' => $errors]) !!}
    <div class="row">
        <div class="col-lg-12">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Account details
                @endslot
                @if(3 >= $user->roles->first()->id)
                    <div class="row d-flex flex-row-reverse">
                        <div class="col-lg-2">
                            <a data-modal href="{{ route('user.account.profile.generate-key-modal') }}" class="btn btn-primary float-right">Generate key</a>
                        </div>
                    </div>
                @endif
                <div class="form-group mt-2">
                    {{ Form::label('email', 'Email') }}
                    @if(null !== $user->email)
                        <div class="input-group has-validation">
                            {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                            @if (null !== $user->email_verified_at)
                                <span class="btn btn-success"><i class="fas fa-check"></i>&nbsp;Verified</span>
                            @else
                                <a href="{{ route('verification.send') }}" class="btn btn-primary">Verify</a>
                            @endif
                        </div>
                    @else
                        {{ Form::email('email', $user->email, ['placeholder' => 'john_doe@outlook.com']) }}
                    @endif
                </div>
                <div class="form-group mt-2">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', $user->username, ['placeholder' => 'johnDoe#5678', 'disabled' => true]) }}
                </div>
                <div class="form-group mt-2">
                    {{ Form::label('discord', 'Discord') }}
                    {{ Form::text('discord', ($user->username . '#' . $user->discriminator ), ['placeholder' => 'johnDoe#5678', 'disabled' => true]) }}
                </div>
                <button class="btn btn-success mt-4 float-right mb-4" type="submit">Save changes</button>
            @endcomponent
        </div>
    </div>
    {!! Form::close() !!}
@endsection
