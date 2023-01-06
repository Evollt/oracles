@extends('layout.templates.container', ['useHeader' => false])

@section('content')
    <x-filter.scam />

    <div class="row">
        <div class="col-lg-12 mt-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Scam
                    <button onclick="window.location.href='{{ route('scam.create') }}'" class="btn btn-primary btn-sm">Create</button>
                @endslot
                <table class="table table-striped" id="scam-datatable" data-ajax="{{ route('scam.datatable') }}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection
