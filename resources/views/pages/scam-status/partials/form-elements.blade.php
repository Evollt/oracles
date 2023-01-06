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
                {{ isset($scamStatus) ? "Update" : "Create" }} scam status
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', isset($scamStatus) ? $scamStatus->name : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('color_id', 'Badge color') }}
                {{ Form::select('color_id', $colors, isset($scamStatus) ? $scamStatus->color->id : null, ['data-placeholder' => 'Pick a color'])}}
            </div>

            @isset($scamStatus)
                <div class="form-group mt-2">
                    {{ Form::label('slug', 'Slug') }}
                    {{ Form::text('slug', isset($scamStatus) ? $scamStatus->slug : null, ['disabled'])}}
                </div>
            @endisset

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($scamStatus) ? "Update" : "Create" }} scam status</button>
            </div>
        @endcomponent
    </div>
    <div class="col-lg-3"></div>
</div>
