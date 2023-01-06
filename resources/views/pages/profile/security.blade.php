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
                    Security preferences
                @endslot
                {!! Form::open(['method' => 'POST', 'route' => ['user.account.security.update'], 'errors' => $errors]) !!}
                    <div class="row">
                        <h5 class="mb-1 text-gray-400">Data Sharing</h5>
                        <p class="small text-muted">Sharing usage data can help us to improve our products and better serve our users as they navigate through our application. When you agree to share usage data with us, crash reports and usage analytics will be automatically sent to our development team for investigation.</p>
                        <div class="form-check ml-3">
                            {{ Form::radio('data_usage', true, $security->data_usage ? true : false) }}
                            {{ Form::label('date_usage', 'Yes, share data and crash reports with dapp developers') }}
                        </div>
                        <div class="form-check ml-3">
                            {{ Form::radio('data_usage', false, !$security->data_usage ? true : false) }}
                            {{ Form::label('date_usage', 'No, limit my data sharing with dapp developers') }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <h5 class="mb-1 text-gray-400">Automatic logout timer</h5>
                        <p>For safety reasons we have added an automatic logout system which by default logs a user out after 30 minutes of inactivity. You are only able to change it to a lower amount of time, the timer cannot be extended to a period longer than 30 minutes.</p>
                        <div class="row">
                            {{ form::number('inactive_timer', auth()->user()->security->inactive_timer ?? 30, ['class' => 'form-control ml-3', 'required']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <h5 class="mb-1 text-gray-400">Anti phishing code</h5>
                        <p>To prevent phishing messages being sent to you, we made the option to add a phishing code. This code will be shown in emails sent from us so you can confirm the message is actually from us and not from someone else.</p>
                        <div class="row">
                            {{ form::text('phishing_code', auth()->user()->security->phishing_code ?? '', ['class' => 'form-control ml-3']) }}
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 mt-3">
                        <button class="btn btn-primary" type="submit" title="Save security settings">
                            Save changes
                        </button>
                    </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
        <div class="col-lg-4">
            @component('components.card')
                @slot('title')
                    Delete account
                @endslot

                <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                <button class="btn btn-danger" type="button" title="Delete account" data-modal="{{ route('user.account.delete') }}">
                    I understand, delete my account
                </button>
            @endcomponent
        </div>
    </div>
@endsection
