@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['scam-category.update', ['scam_status' => $scamCategory->id]], 'errors' => $errors]) }}
                @include('pages.scam-category.partials.form-elements', ['scamCategory' => $scamCategory])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
