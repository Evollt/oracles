@extends('layout.templates.container', ['useHeader' => true])

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                @component('components.card')
                    @slot('title')
                        <span>Email verification</span>
                    @endslot
                        <p>Please enter the received code from the inbox from the entered email address</p>
                            {{ Form::open(['method' => 'POST', 'route' => ['verification.verify', 'errors' => $errors]]) }}
                                {{ Form::text('verification_code', '', ['class' => 'form-control col-md-4', 'required', 'autocomplete' => 'off', 'maxlength' => 6, 'minlength' => 6])}}
                                <div class="form-group">
                                    <div class="d-flex flex-row-reverse mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                        <div class="mt-2 mr-2"><a href="{{ route('verification.send') }}">Resend email</a></div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                @endcomponent
            </div>
        </div>
    </div>
@endsection
