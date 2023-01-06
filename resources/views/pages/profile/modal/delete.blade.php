@component('components.modal')
    @slot('title')
        Delete account
    @endslot
    {{ Form::open(['method' => 'post', 'route' => ['user.account.destroy'], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        <p>
            Are you sure that you want to delete your account?
        </p>
        <div class="modal-footer">
            <div class="form-buttons flex justify-end">
                <button class="btn btn-danger place-self-end submit" type="submit">Delete</button>
            </div>
        </div>
    {!! Form::close() !!}
@endcomponent
