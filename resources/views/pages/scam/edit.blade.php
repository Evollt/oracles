@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['scam.update', ['scam' => $scam->id]], 'errors' => $errors]) }}
                @include('pages.scam.partials.form-elements', ['scam' => $scam])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
