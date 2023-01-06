@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['scam-status.update', ['scam_status' => $scamStatus->id]], 'errors' => $errors]) }}
                @include('pages.scam-status.partials.form-elements', ['scamStatus' => $scamStatus])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
