@extends('layout.templates.container', ['useHeader' => false])

@section('content')

    <div class="row">
        <div class="col-lg-12 mt-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    All users
                @endslot
                <table class="table table-striped" id="users-datatable" data-ajax="{{ route('users.datatable') }}">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Discord</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection
