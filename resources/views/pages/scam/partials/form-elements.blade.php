<div class="row">
    <div class="col-lg-12">
        <div class="mb-4 float-left">
            <a href="{{ route('scam.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-1"></i>Back</a>
        </div>
        @if (isset($scam))
            <div class="mb-4 float-right">
                <a data-modal href="{{ route('scam.status', $scam) }}" class="btn btn-outline-white">Update status</i></a>
                @can('scam.post')
                    @if ('posted' !== $scam->scamStatus->slug)
                        <a href="{{ route('scam.post', $scam) }}" class="btn btn-outline-success">Post<i class="fas fa-arrow-right ml-1"></i></a>
                    @endif
                @endcan
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        @component('components.card', ['collapseAble' => false])
            @slot('title')
                {{ isset($scam) ? "Update" : "Create" }} scam
                @if (isset($scam) && null !== $scam->scamStatus)
                    <span class="btn btn-sm {{ $scam->scamStatus->color }}" style="color: {{ $scam->scamStatus->color->text }}; background-color: {{ $scam->scamStatus->color->background }};">{{ $scam->scamStatus->name }}</span>
                @endif
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('old_title', 'Submitted title') }}
                {{ Form::text('old_title', isset($scam) ? $scam->old_title : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('old_text', 'Submitted text') }}
                {{ Form::textarea('old_text', isset($scam) ? $scam->old_text : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('scam_status_id', 'Scam category') }}
                {{ Form::select('scam_status_id', $scamCategories->toArray() + ['' => ''], isset($scam) ? $scam->scamCategory->id : null, ['data-placeholder' => 'Pick a scam category'])}}
            </div>

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($scam) ? "Update" : "Create" }} scam</button>
            </div>
        @endcomponent
    </div>
    <div class="col-lg-6">
        @component('components.card', ['collapseAble' => false])
            @slot('title')
                Post data
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('post_title', 'Post title') }}
                {{ Form::text('post_title', isset($scam) ? $scam->post_title : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('post_text', 'Post text') }}
                {{ Form::textarea('post_text', isset($scam) ? $scam->post_text : null)}}
            </div>

            <div class="form-group mt-2">
                {{ Form::label('post_image', 'Post image') }}
                {{ Form::text('post_image', isset($scam) ? $scam->post_image : null)}}
            </div>
        @endcomponent
    </div>
    @if (isset($scam) && null !== $scam->images)
        <div class="col-lg-6 mt-4 mb-4">
            @component('components.card', ['collapseAble' => false])
                @slot('title')
                    Images
                @endslot
                @foreach ($scam->images as $image)
                    <a href="{{ $image }}" class="mt-2 text-white text-decoration-underline" target="_blank">{{ $image }}</a>
                @endforeach
            @endcomponent
        </div>
    @endif
</div>
