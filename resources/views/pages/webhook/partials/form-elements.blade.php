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
                {{ isset($webhook) ? "Update" : "Create" }} webhook
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', isset($webhook) ? $webhook->name : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('discord', 'Discord invite link') }}
                {{ Form::text('discord', isset($webhook) ? $webhook->discord : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('url', 'Webhook url') }}
                {{ Form::text('url', isset($webhook) ? $webhook->url : null)}}
            </div>

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($webhook) ? "Update" : "Create" }} webhook</button>
            </div>
        @endcomponent
    </div>
    <div class="col-lg-3"></div>
</div>
