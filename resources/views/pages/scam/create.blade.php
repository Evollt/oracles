@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['scam.store'], 'errors' => $errors]) }}
                @include('pages.scam.partials.form-elements', ['scam' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
