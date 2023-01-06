<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-dark bg-dark" id="sidenavAccordion">
    <button class="btn btn-icon order-1 order-lg-0 me-2 ms-lg-2 me-lg-0 text-white" id="sidebarToggle"><i data-feather="menu"></i></button>
    <a href="{{ route('scam.index') }}" class="btn btn-icon">
        <img class="img-fluid" width="25" src="{{ URL::asset('images/logo.png') }}" />
    </a>
    <a class="navbar-brand pe-3 ps-4 ps-lg-2 text-white" href="{{ route('scam.index') }}">
        {{ env('APP_NAME') }}
    </a>
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- User Dropdown-->
        <x-navigation.account/>
    </ul>
</nav>
