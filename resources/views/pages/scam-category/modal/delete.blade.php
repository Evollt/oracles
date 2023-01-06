@component('components.modal')
    {{ Form::open(['method' => 'DELETE', 'route' => ['scam-category.destroy', ['scam_status' => $scamCategory->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            Delete scam category: {{ $scamCategory->name }}
        @endslot
        <p>
            Are you sure you wanna delete scam category: {{ $scamCategory->name }}?
        </p>

        <hr class="mt-4 mb-4">

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2 ">Cancel</button>
            <button class="btn btn-danger" type="submit">Delete</button>
        </div>
    {!! Form::close() !!}
@endcomponent
