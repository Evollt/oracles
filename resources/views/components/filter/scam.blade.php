@component('components.card', ['collapseAble' => true])
    @slot('title')
        Filters
    @endslot
    <form action="" class="advanced-scam-search">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('filter_status', 'Status') }}
                    {{ Form::select('filter_status', $statuses, isset($session->filter_status) ? $session->filter_status : null, ['data-placeholder' => 'Select status', 'style' => 'width: 200px'])}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('filter_category', 'Category') }}
                    {{ Form::select('filter_category', $categories, isset($session->filter_category) ? $session->filter_category : null, ['data-placeholder' => 'Select Category', 'style' => 'width: 200px'])}}
                </div>
            </div>
        </div>
        <div class="mt-4 mb-4" style="float: right;">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </form>
@endcomponent
