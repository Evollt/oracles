@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['subscriber.update', ['subscriber' => $subscriber->id]], 'errors' => $errors]) }}
                @include('pages.subscriber.partials.form-elements', ['subscriber' => $subscriber])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
