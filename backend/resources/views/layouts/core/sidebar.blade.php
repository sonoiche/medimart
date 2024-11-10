<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index-2.html">
            <span class="sidebar-brand-text align-middle">
                MEDIMART
            </span>
            <svg
                class="sidebar-brand-icon align-middle"
                width="32px"
                height="32px"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#FFFFFF"
                stroke-width="1.5"
                stroke-linecap="square"
                stroke-linejoin="miter"
                color="#FFFFFF"
                style="margin-left: -3px;"
            >
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="{{ url('assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title" href="#">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="sidebar-user-subtitle">{{ auth()->user()->role }}</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('home') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->role == 'Customer')
            <li class="sidebar-item">
                <a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-bag"></i>
                    <span class="align-middle">My Products</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('client/products') }}">My Products</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('client/products/create') }}">Add New Product</a></li>
                </ul>
            </li>
            @endif

            @if (auth()->user()->role == 'Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('admin/admin-products') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Products</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('admin/admin-transactions') }}">
                    <i class="align-middle" data-feather="credit-card"></i>
                    <span class="align-middle">Transactions</span>
                </a>
            </li>
            @else
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('client/transactions') }}">
                    <i class="align-middle" data-feather="credit-card"></i>
                    <span class="align-middle">Transactions</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('admin/admin-users') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role != 'Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('client/orders') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">My Orders</span>
                </a>
            </li>
            @endif

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="calendar.html">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed"> <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span> </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-reset-password.html">Reset Password <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-404.html">404 Page <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-500.html">500 Page <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>