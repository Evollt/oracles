@component('components.modal')
    {{ Form::open(['method' => 'POST', 'route' => ['scam.status-update', ['scam' => $scam->id]], 'errors' => $errors, 'class' => 'ajax', 'data-container' => '.modal-window']) }}
        @slot('title')
            Update scam status: {{ $scam->old_title }}
        @endslot

        <div class="form-group mt-2 mb-4">
            {{ Form::label('scam_status_id', 'Scam status') }}
            {{ Form::select('scam_status_id', $scamStatuses->toArray(), $scam->scamStatus->id, ['data-placeholder' => 'Pick a scam status'])}}
        </div>

        <div style="float: right;">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary mr-2 ">Cancel</button>
            <button class="btn btn-success" type="submit">Update Status</button>
        </div>
    {!! Form::close() !!}
@endcomponent
