@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['webhook.update', ['webhook' => $webhook->id]], 'errors' => $errors]) }}
                @include('pages.webhook.partials.form-elements', ['webhook' => $webhook])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
