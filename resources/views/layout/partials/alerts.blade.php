@if (session()->has('success'))
    <div class="alert alert-success alert-icon" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon-aside">
            <i class="fas fa-check"></i>
        </div>
        <div class="alert-icon-content">
            {!! session()->get('success') !!}
        </div>
    </div>
@endif

@if (session()->has('notice'))
    <div class="alert alert-warning alert-icon" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon-aside">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="alert-icon-content">
            {!! session()->get('notice') !!}
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-icon" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon-aside">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="alert-icon-content">
            {!! session()->get('error') !!}
        </div>
    </div>
@endif
