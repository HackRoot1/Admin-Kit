<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='index.html'>
            <span class="sidebar-brand-text align-middle">
                Project
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Access Control
            </li>
            {{-- @permission('view-staff') --}}
                <li class="sidebar-item">
                    <a class='sidebar-link' href='{{ route('staffs.index') }}'>
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Staffs</span>
                    </a>
                </li>
            {{-- @endpermission --}}

            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('roles.index') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Roles</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('permissions.index') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span
                        class="align-middle">Permissions</span>
                </a>
            </li>

            <li class="sidebar-header">
                To Do App
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('tasks.index') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">List Task</span>
                </a>
            </li>

            <li class="sidebar-header">
                Additional Pages
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('invoices.index') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('chat') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Chat</span>
                </a>
            </li>

            <li class="sidebar-header">
                Payments
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('invoices.checkout') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Checkout</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('invoices.payments') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Payments</span>
                </a>
            </li>

            <li class="sidebar-header">
                Logs
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('activity.log') }}'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Activity
                        Logs</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-primary">
                            Log out
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
