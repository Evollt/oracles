@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12 mt-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Webhook
                    <button onclick="window.location.href='{{ route('webhook.create') }}'" class="btn btn-primary btn-sm">Create</button>
                @endslot
                <table class="table table-striped" id="webhook-datatable" data-ajax="{{ route('webhook.datatable') }}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Discord invite url</th>
                            <th>Webhook url</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection
