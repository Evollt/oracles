<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="mb-4 float-left">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-1"></i>Back</a>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        @component('components.card', ['collapseAble' => false])
            @slot('title')
                {{ isset($subscriber) ? "Update" : "Create" }} subscriber
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('user_id', 'User') }}
                {{ Form::select('user_id', $users, isset($subscriber) ? $subscriber->user->id : null, ['data-placeholder' => 'Pick a user'])}}
            </div>
            <div class="form-group mt-4">
                {{ Form::boolean('receive_message', 'Enable direct discord message', $subscriber ? $subscriber->receive_message : false) }}
            </div>

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($subscriber) ? "Update" : "Create" }} subscriber</button>
            </div>
        @endcomponent
    </div>
    <div class="col-lg-3"></div>
</div>
