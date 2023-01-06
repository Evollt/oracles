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
                {{ isset($color) ? "Update" : "Create" }} color
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', isset($color) ? $color->name : null)}}
            </div>

            @isset($color)
                <div class="form-group mt-2">
                    {{ Form::label('slug', 'Slug') }}
                    {{ Form::text('slug', isset($color) ? $color->slug : null, ['disabled'])}}
                </div>
            @endisset

            <div class="form-group mt-2">
                {{ Form::label('border', 'Border color (HEX code)') }}
                {{ Form::text('border', isset($color) ? $color->border : null, ['data-placeholder' => 'Pick a border color'])}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('background', 'Background color (HEX code)') }}
                {{ Form::text('background', isset($color) ? $color->background : null, ['data-placeholder' => 'Pick a background color'])}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('text', 'Text color (HEX code)') }}
                {{ Form::text('text', isset($color) ? $color->text : null, ['data-placeholder' => 'Pick a text color'])}}
            </div>

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($color) ? "Update" : "Create" }} color</button>
            </div>
        @endcomponent
    </div>
    <div class="col-lg-3"></div>
</div>
