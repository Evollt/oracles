<div class="card">
    {{ $image }}
    <div class="card-body">
        <a href="{{ $os }}">
            <h5 class="card-title">{{ $name }}</h5>
            <p class="card-text">
                #{{ $hint ?? $title }}
            </p>
        </a>
    </div>
</div>
