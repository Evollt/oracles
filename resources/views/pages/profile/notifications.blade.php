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

    <div class="row">
        <div class="col-lg-8">
            @component('components.card')
                @slot('title')
                    Email notifications
                @endslot
                {!! Form::open(['method' => 'POST', 'route' => ['user.account.profile.update'], 'errors' => $errors]) !!}
                    <div class="mb-3">
                        {{ Form::label('email', 'Default notification email') }}
                        {{ Form::text('email', $notification->user->email ?? 'No default email', ['disabled']) }}
                    </div>
                    <div class="mb-0">
                        <label class="small mb-2">Choose which types of email updates you receive</label>
                        <div class="form-check">
                            {{ Form::checkbox('security', true, $notification->security ?? true, ['disabled']) }}
                            {{ Form::label('security', 'Security alerts') }}
                        </div>
                    </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
        <div class="col-lg-4">
            @component('components.card')
                @slot('title')
                    Notification preferences
                @endslot

                <button class="btn btn-danger">
                    Unsubscribe from all notifications
                </button>
            @endcomponent
        </div>
    </div>
@endsection
