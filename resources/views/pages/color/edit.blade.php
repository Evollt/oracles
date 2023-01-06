@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['color.update', ['color' => $color->id]], 'errors' => $errors]) }}
                @include('pages.color.partials.form-elements', ['color' => $color])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
