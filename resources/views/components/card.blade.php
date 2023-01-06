@php
    $id = str_replace(' ', '-', strtolower($hint ?? $title)) . random_int(0, 9999999999999);
@endphp
<div class="card card-collapsable card-header-actions bg-dark">
    @if(isset($collapseAble) && true === $collapseAble)
        <a href="#{{ $id }}" class="card-header" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="{{ $id }}">
            {{ $hint ?? $title }}
            @if(isset($collapseAble) && true === $collapseAble)
                <div class="card-collapsable-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            @endif
        </a>
    @else
        <div class="card-header">
            {{ $hint ?? $title }}
        </div>
    @endif
    <div class="collapse show" id="{{ $id }}">
        <div class="card-body  @if(isset($extraBodyClasses)) {{ $extraBodyClasses }} @endif">
            {{ $slot }}
        </div>
    </div>
</div>
