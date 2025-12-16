<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('backoffice.index') }}">
                <img class="img-fluid for-light ms-5" width="115" src="{{ asset('images/logo.png') }}"
                    alt="">
                <img class="img-fluid for-dark ms-5" width="115" src="{{ asset('images/logo.png') }}"
                    alt="">
            </a>
            <div class="back-btn">
                <i class="fa-solid fa-angle-left"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('backoffice.index') }}"><img class="img-fluid"
                    src="{{ asset('assets/backoffice/images/logo/logo-icon.png') }}" alt=""></a>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('backoffice.index') }}">
                            <img class="img-fluid" src="{{ asset('images/logo.png') }}"
                                alt="">
                        </a>
                    </li>

                    {{-- quickaccess --}}
                    <li class="sidebar-main-title mt-5">
                        <div>
                            <h6>Quick Access</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('backoffice.index') }}">
                                <i data-feather="grid" class="text-muted"></i>
                                <span class="pl-5">Dashboard</span>
                            </a>
                        </li>
                    </li>

                    {{-- @if($auth->canAny(['backoffice.admin.index','backoffice.user.index','backoffice.user.index','backoffice.supplier.index','backoffice.product.index','backoffice.buyer.index','backoffice.user_role.index','backoffice.access_control.index'],'admin',)) --}}
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Menu</h6>
                            </div>
                        </li>

                        {{-- @if($auth->canAny(['backoffice.admin.index'],'admin')) --}}
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('backoffice.admin.index') }}">
                                    <i data-feather="user" class="text-muted"></i>
                                    <span class="pl-5">Administrators </span>
                                </a>
                            </li>
                        {{-- @endif --}}

                        {{-- @if($auth->canAny(['backoffice.user.index'],'admin')) --}}
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{-- route('backoffice.user.index') --}}">
                                    <i data-feather="user" class="text-muted"></i>
                                    <span class="pl-5">Registered Account</span>
                                </a>
                            </li>
                        {{-- @endif --}}

                        {{-- @if($auth->canAny(['backoffice.supplier.index'],'admin')) --}}
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{-- route('backoffice.supplier.index') --}}">
                                    <i data-feather="shopping-cart" class="text-muted"></i>
                                    <span class="pl-5">Suppliers</span>
                                </a>
                            </li>
                        {{-- @endif --}}

                        {{-- @if($auth->canAny(['backoffice.product.index'],'admin'))
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav"
                                    href="{{ route('backoffice.product.index') }}">
                                    <i data-feather="tag" class="text-muted"></i>
                                    <span class="pl-5">Product</span>
                                </a>
                            </li>
                        @endif

                        @if($auth->canAny(['backoffice.buyer.index'],'admin'))
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('backoffice.buyer.index') }}">
                                    <i data-feather="users" class="text-muted"></i>
                                    <span class="pl-5">Interested Buyers</span>
                                </a>
                            </li>
                        @endif 

                        @if($auth->canAny(['backoffice.user_role.index'],'admin'))
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav"
                                    href="{{ route('backoffice.user_role.index') }}">
                                    <i data-feather="settings" class="text-muted"></i>
                                    <span class="pl-5">User Roles</span>
                                </a>
                            </li>
                        @endif 

                        @if($auth->canAny(['backoffice.access_control.index'],'admin'))
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav"
                                    href="{{ route('backoffice.access_control.index') }}">
                                    <i data-feather="shield" class="text-muted"></i>
                                    <span class="pl-5">Access Controls</span>
                                </a>
                            </li>
                        @endif  --}}
                    {{-- @endif --}}

                    <li class="mb-5">
                    </li>

                </ul>

            </div>
        </nav>
    </div>
</div>
