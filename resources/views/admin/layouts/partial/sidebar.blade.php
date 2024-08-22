<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">Menu</li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fa fa-desktop" aria-hidden="true"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('information*') ? 'active' : '' }}" href="{{ route('information.index') }}">
                            <i class="fa fa-cog" aria-hidden="true"></i> Information Data
                        </a>
                    </li>

                    @if(Auth::user()->user_role == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#submenu-payment-method" aria-controls="submenu-payment-method" aria-expanded="{{ Request::routeIs('product*') || Request::routeIs('category*') ? 'true' : 'false' }}">
                                <i class="fa fa-fw fa-user-circle"></i>Products <span class="badge badge-success">6</span>
                            </a>
                            <div id="submenu-payment-method" class="collapse {{ Request::routeIs('product*') || Request::routeIs('category*') ? 'show' : '' }}">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index') }}">Category</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs('product.create') ? 'active' : '' }}" href="{{ route('product.create') }}">Products Add</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">Products List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if(Auth::user()->user_role == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('staff*') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}" href="#" data-toggle="collapse" data-target="#submenu-staff" aria-controls="submenu-staff">
                                <i class="fa fa-fw fa-user-circle"></i>Staff Info <span class="badge badge-success">6</span>
                            </a>
                            <div id="submenu-staff" class="collapse {{ Request::routeIs('staff*') ? 'show' : '' }}">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs('staff.create') ? 'active' : '' }}" href="{{ route('staff.create') }}">Staff Add</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs('staff.index') ? 'active' : '' }}" href="{{ route('staff.index') }}">Staff List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if(Auth::user()->user_role == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('setting*') ? 'active' : '' }}" href="{{ route('setting.index') }}">
                                <i class="fa fa-cog" aria-hidden="true"></i> Setting
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
