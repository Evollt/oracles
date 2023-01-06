<li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
    <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ $user->profile_image }}" /></a>
    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
        <h6 class="dropdown-header d-flex align-items-center">
            <img class="dropdown-user-img" src="{{ $user->profile_image }}" />
            <div class="dropdown-user-details">
                <div class="dropdown-user-details-name">{{ $user->username }}</div>
                @if (null !== $user->email)
                    <div class="dropdown-user-details-email">{{ $user->email }}</div>
                @endif
                <div class="dropdown-user-details-wallet">{{ $user->wallet }}</div>
            </div>
        </h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('user.account.profile') }}">
            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
            Account
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}">
            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
            Logout
        </a>
    </div>
</li>
