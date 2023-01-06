@component('components.modal')
    {{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', ['role' => $role->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            Delete role: {{ $role->name }}
        @endslot
        <p>
            Are you sure you wanna delete role: {{ $role->name }}?
        </p>

        <hr class="mt-4 mb-4">

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2 ">Cancel</button>
            <button class="btn btn-danger" type="submit">Delete</button>
        </div>
    {!! Form::close() !!}
@endcomponent
