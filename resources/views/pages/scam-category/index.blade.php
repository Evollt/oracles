@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12 mt-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Scam Category
                    <button onclick="window.location.href='{{ route('scam-category.create') }}'" class="btn btn-primary btn-sm">Create</button>
                @endslot
                <table class="table table-striped" id="scam-category-datatable" data-ajax="{{ route('scam-category.datatable') }}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection
