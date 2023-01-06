@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12 mt-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Subscriber
                    <button onclick="window.location.href='{{ route('subscriber.create') }}'" class="btn btn-primary btn-sm">Create</button>
                @endslot
                <table class="table table-striped" id="subscriber-datatable" data-ajax="{{ route('subscriber.datatable') }}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Enabled?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection
