<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span class="text-capitalize">
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">NAVIGATION</h4>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'service' ? 'active' : '' }}">
                    <a href="{{ route('service.index') }}">
                        <i class="icon-wrench"></i>
                        <p>Service</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'transaction' ? 'active' : '' }}">
                    <a href="{{ route('transaction.index') }}">
                        <i class="icon-basket"></i>
                        <p>Transaction</p>
                    </a>
                </li>

                {{-- /Menu Master --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">MODUL MASTER</h4>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'user' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}">
                        <i class="far fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'report' ? 'active' : '' }}">
                    <a href="{{ route('report.index') }}">
                        <i class="icon-notebook"></i>
                        <p>Report</p>
                    </a>
                </li>
                {{-- /Menu Master --}}
            </ul>
        </div>
    </div>
</div>
