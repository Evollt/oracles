@component('components.modal')
    @slot('title')
        Generate api key
    @endslot
    {{ Form::open(['method' => 'post', 'route' => ['user.account.profile.generate-key'], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        <p>
            Are you sure you want to regenerate your api key? Regenerating will remove the current and replace it for a new one. Because of this the current api key will lose it's functionality.
        </p>
        <p>
            The new key will be showed in the success message and will only be shown once, make sure to save this key somewhere safe!
        </p>
        <div class="modal-footer">
            <div class="form-buttons flex justify-end">
                <button class="btn btn-danger place-self-end submit" type="submit">Regenerate</button>
            </div>
        </div>
    {!! Form::close() !!}
@endcomponent
