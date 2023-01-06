<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-dark">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                @foreach ($items as $title => $item)
                    @if(can_visit($item))
                        @if(isset($item['children']))
                            <div class="sidenav-menu-heading">{{ $title }}</div>
                            @foreach ($item['children'] as $childTitle => $child)
                                @if(can_visit($child))
                                    @if(isset($child['children']))
                                        <!-- Sidenav Accordion (Pages)-->
                                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '', strtolower($childTitle)) }}" aria-expanded="false" aria-controls="{{ str_replace(' ', '', strtolower($childTitle)) }}">
                                            <div class="nav-link-icon"><i class="{{ $child['icon'] }}"></i></div>
                                            {{ $childTitle }}
                                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="{{ str_replace(' ', '', strtolower($childTitle)) }}" data-bs-parent="#accordionSidenav">
                                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenav{{ str_replace(' ', '', strtolower($childTitle)) }}">
                                                @foreach ($child['children'] as $grandChildTitle => $grandChild)
                                                    @if(can_visit($grandChild))
                                                        @if(isset($grandChild['children']))
                                                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '', strtolower($childTitle)) }}{{ str_replace(' ', '', strtolower($grandChildTitle)) }}" aria-expanded="false" aria-controls="pagesCollapseAccount">
                                                                {{ $grandChildTitle }}
                                                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                                            </a>
                                                            <div class="collapse" id="{{ str_replace(' ', '', strtolower($childTitle)) }}{{ str_replace(' ', '', strtolower($grandChildTitle)) }}" data-bs-parent="#accordionSidenav{{ str_replace(' ', '', strtolower($childTitle)) }}">
                                                                <nav class="sidenav-menu-nested nav">
                                                                    @foreach ($grandChild['children'] as $grandGrandChildTitle => $grandGrandChild)
                                                                        @if(can_visit($grandGrandChild))
                                                                            <a class="nav-link" @isset($grandGrandChild['route']) href="{{ route($grandGrandChild['route']) }}" @endisset>
                                                                                {{ $grandGrandChildTitle }}
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                </nav>
                                                            </div>
                                                        @else
                                                            <a class="nav-link" @isset($grandChild['route']) href="{{ route($grandChild['route']) }}" @endisset>
                                                                {{ $grandChildTitle }}
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </nav>
                                        </div>
                                    @else
                                        <a class="nav-link" @isset($child['route']) href="{{ route($child['route']) }}" @endisset>
                                            <div class="nav-link-icon"><i class="{{ $child['icon'] }}"></i></div>
                                            {{ $childTitle }}
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <a class="nav-link" @isset($item['route']) href="{{ route($item['route']) }}" @endisset>
                                <div class="nav-link-icon"><i class="{{ $item['icon'] }}"></i></div>
                                {{ $title }}
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer bg-navbar">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{ auth()->user()->username }}</div>
            </div>
        </div>
    </nav>
</div>
