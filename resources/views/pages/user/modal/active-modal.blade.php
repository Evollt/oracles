@component('components.modal')
    {{ Form::open(['method' => 'post', 'route' => ['users.active-toggle', ['user' => $user->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            {{ $user->deactivated_at ? 'Activate' : 'Deactivate' }} user: {{ $user->id }}
        @endslot
        <p>
            Are you sure you wanna {{ $user->deactivated_at ? 'activate' : 'deactivate' }} user: {{ $user->name }}?
        </p>

        <hr class="mt-4 mb-4">

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2 ">Cancel</button>
            <button class="btn btn-{{ $user->deactivated_at ? 'success' : 'danger' }}" type="submit">{{ $user->deactivated_at ? 'Activate' : 'Deactivate' }}</button>
        </div>
    {!! Form::close() !!}
@endcomponent
