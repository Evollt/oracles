@component('components.modal')
    {{ Form::open(['method' => 'post', 'route' => ['users.role-update', ['user' => $user->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            Update role for user: {{ $user->id }}
        @endslot

        <div class="form-group mt-2">
            {{ Form::label('role', 'Role') }}
            {{ Form::select('role',['' => 'Please select an role'] + $roles->toArray()) }}
        </div>

        <hr class="mt-4 mb-4">

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2">Cancel</button>
            <button class="btn btn-success" type="submit">Update user role</button>
        </div>
    {!! Form::close() !!}
@endcomponent
