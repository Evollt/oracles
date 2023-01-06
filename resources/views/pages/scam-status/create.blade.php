@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['scam-status.store'], 'errors' => $errors]) }}
                @include('pages.scam-status.partials.form-elements', ['scamStatus' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
