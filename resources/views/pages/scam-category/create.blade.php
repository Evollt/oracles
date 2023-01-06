@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'post', 'route' => ['scam-category.store'], 'errors' => $errors]) }}
                @include('pages.scam-category.partials.form-elements', ['scamCategory' => null])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
