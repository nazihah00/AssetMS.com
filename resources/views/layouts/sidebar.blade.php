<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo d-flex align-items-center">
                            <img src="{{ url('assets/images/logo/KSSB.png') }}" alt="Logo" style="height: 45px; margin-right: 20px;">
                            <div>
                                <h5 class="auth-title mb-0" style="font-size: 15px;">KSSB ICT AssetsMS</h5> 
                                <p style="font-size: 10px; margin-bottom:-20px;">ICT Assets Management System</p>
                            </div>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub {{ request()->is('auth/register') || request()->is('auth/userlist') ? 'active' : '' }}"> 
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>User Management</span> 
                            </a>
                            <ul class="submenu {{ request()->is('auth/register') || request()->is('auth/userlist') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->is('register') ? 'active' : '' }}">
                                    <a href="{{ url('auth/register') }}">Register User</a>
                                </li>
                                <li class="submenu-item {{ request()->is('auth/userlist') ? 'active' : '' }}">
                                    <a href="{{ url('auth/userlist') }}">User List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub {{ request()->is('assets/list') || request()->is('assets/assetssetting') || request()->is('disposal/list') || request()->is('relocation/list') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Asset Management</span>
                            </a>
                            <ul class="submenu {{ request()->is('assets/assetssetting') || request()->is('assets/list') || request()->is('disposal/list') || request()->is('relocation/list') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->is('assets/list') ? 'active' : '' }}">
                                    <a href="{{ url('assets/list') }}">List of Assets</a>
                                </li>
                                <li class="submenu-item {{ request()->is('assets/assetssetting') ? 'active' : '' }}">
                                    <a href="{{ url('assets/assetssetting') }}">Assets Settings</a>
                                </li>
                                <li class="submenu-item {{ request()->is('disposal/list') ? 'active' : '' }}">
                                    <a href="{{ url('disposal/list') }}">Assets Disposal</a>
                                </li>
                                <li class="submenu-item {{ request()->is('relocation/list') ? 'active' : '' }}">
                                    <a href="{{ url('relocation/list') }}">Assets Relocation/Transfer</a>
                                </li>
                            </ul>
                             
                        </li>
                        <li class="sidebar-item has-sub {{ request()->is('maintenance/list') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-wrench-adjustable"></i>
                                <span>Maintenance and Repair</span>
                            </a>
                            <ul class="submenu {{ request()->is('maintenance/list') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->is('maintenance/list') ? 'active' : '' }}">
                                    <a href="{{ url('maintenance/list') }}">List of Maintenance and Repair</a>
                                </li>
                            </ul> 
                        </li>
                        <li class="sidebar-item {{ request()->is('/login') ? 'active' : '' }}">
                            <a href="{{ route('logout') }}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
</div>