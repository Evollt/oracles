@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['roles.store'], 'errors' => $errors]) }}
                @include('pages.role.partials.form-elements')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
