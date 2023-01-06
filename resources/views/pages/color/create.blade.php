@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['color.store'], 'errors' => $errors]) }}
                @include('pages.color.partials.form-elements', ['color' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
