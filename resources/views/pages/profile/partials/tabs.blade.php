<nav class="nav nav-borders">
    <a href="{{ route('user.account.profile') }}" class="nav-link ml-0 d-lg-block d-md-block d-flex flex-column align-items-center @if('Profile' == $navName) active @endif">
        <i class="far fa-id-card mr-lg-2 mr-md-2 m-0 fs-sm-28"></i>
        <p class="d-none d-lg-inline-block d-md-inline-block">
            Profile
        </p>
    </a>
    <a href="{{ route('user.account.security') }}" class="nav-link d-lg-block d-md-block d-flex flex-column align-items-center @if('Security' == $navName) active @endif">
        <i class="fas fa-user-shield mr-lg-2 mr-md-2 m-0 fs-sm-28"></i>
        <p class="d-none d-lg-inline-block d-md-inline-block">
            Security
        </p>
    </a>
    <a href="{{ route('user.account.notifications') }}" class="nav-link d-lg-block d-md-block d-flex flex-column align-items-center @if('Notifications' == $navName) active @endif">
        <i class="fas fa-bell mr-lg-2 mr-md-2 m-0 fs-sm-28"></i>
        <p class="d-none d-lg-inline-block d-md-inline-block">
            Notifications
        </p>
    </a>
    {{-- <a href="{{ route('user.account.nfts') }}" class="nav-link d-lg-block d-md-block d-flex flex-column align-items-center @if('Nfts' == $navName) active @endif">
        <i class="fas fa-images mr-lg-2 mr-md-2 m-0 fs-sm-28"></i>
        <p class="d-none d-lg-inline-block d-md-inline-block">
            My wallet
        </p>
    </a> --}}
    {{-- <a href="{{ route('user.account.profile') }}" class="nav-link d-lg-block d-md-block d-flex flex-column align-items-center @if('Settings' == $navName) active @endif">
        <i class="fas fa-user-cog mr-lg-2 mr-md-2 m-0 fs-sm-28"></i>
        <p class="d-none d-lg-inline-block d-md-inline-block">
            Settings
        </p>
        TODO: What do we want to have as settings?
    </a> --}}
</nav>
