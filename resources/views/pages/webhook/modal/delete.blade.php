@component('components.modal')
    {{ Form::open(['method' => 'DELETE', 'route' => ['webhook.destroy', ['webhook' => $webhook->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            Delete webhook: {{ $webhook->name }}
        @endslot
        <p>
            Are you sure you wanna delete webhook: {{ $webhook->name }}?
        </p>

        <hr class="mt-4 mb-4">

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2 ">Cancel</button>
            <button class="btn btn-danger" type="submit">Delete</button>
        </div>
    {!! Form::close() !!}
@endcomponent
