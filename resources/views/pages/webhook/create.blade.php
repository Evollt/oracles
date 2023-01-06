@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['webhook.store'], 'errors' => $errors]) }}
                @include('pages.webhook.partials.form-elements', ['webhook' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
