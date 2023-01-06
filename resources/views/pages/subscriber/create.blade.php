@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['subscriber.store'], 'errors' => $errors]) }}
                @include('pages.subscriber.partials.form-elements', ['subscriber' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
