<div class="row">
    <div class="col-lg-6">
        <div class="mb-4 float-left">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-1"></i>Back</a>
        </div>
    </div>
    <div class="col-lg-6"></div>
</div>
<div class="row">
    <div class="col-lg-6">
        @component('components.card', ['collapseAble' => false])
            @slot('title')
                {{ isset($role) ? "Update" : "Create" }} role
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', isset($role) ? $role->name : null)}}
            </div>

            <div class="mt-4 mb-4" style="float: right;">
                <button class="btn btn-success" type="submit">{{ isset($role) ? "Update" : "Create" }} role</button>
            </div>
        @endcomponent
    </div>

    <div class="col-lg-6">
        @component('components.card', ['collapseAble' => false])
            @slot('title')
                Role display color
            @endslot
            <div class="form-group mt-2">
                {{ Form::label('slug', 'Color') }}
                {{ Form::select('slug', $colors, isset($role) ? $role->slug : null, ['data-placeholder' => 'Pick a color'])}}
            </div>
        @endcomponent
    </div>
</div>
<div class="row mt-4">
    @php
        $createComponent = true;
    @endphp
    @foreach ($permissions as $permission)
        @php
            preg_match('/(.*)\./', $permission->name, $matches);
        @endphp
        @if ($loop->first)
            @php
                $value = $matches[1];
            @endphp
        @else
            @php
                if($value !== $matches[1]){
                    $value = $matches[1];
                    $createComponent = true;
                }else{
                    $createComponent = false;
                }
            @endphp
        @endif
        @if (true === $createComponent)
            @if (!$loop->first)
                @endcomponent
                </div>
            @endif
            <div class="col-lg-4 mb-2 mt-2">
            @component('components.card', ['collapseAble' => true])
                @slot('title')
                    {{ ucfirst($value) }}
                @endslot
        @endif
            <div class="form-group mt-2">
                {{ Form::boolean('permissions[' . $permission->id . ']', $permission->name, isset($role) ? $role->hasPermissionTo($permission->name) : false) }}
            </div>
        @if ($loop->last)
            @endcomponent
            </div>
        @endif
    @endforeach
</div>
