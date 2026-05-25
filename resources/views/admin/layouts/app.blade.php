<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        404 Coffee — @yield('title')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/admin/layout.css') }}">

    @stack('styles')

</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <!-- HEADER -->
        <div class="sidebar-header">

            <div class="brand">

                <span class="brand-name">

                    404.COFFEE SYSTEM

                </span>

            </div>

            <div
                class="user-badge"
                title="Logged in as {{ auth()->user()->name }}">

                <div class="avatar-wrapper">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff&bold=true"
                        alt="Avatar"
                        class="user-avatar">

                    <div class="online-indicator"></div>

                </div>

                <span class="user-name">

                    {{ auth()->user()->name }}

                </span>

            </div>

        </div>

        <div class="sidebar-divider"></div>

        <!-- MENU -->
        <nav class="menu">

            <!-- DASHBOARD -->
            <a href="/admin"
               class="{{ request()->is('admin') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <rect
                        x="3"
                        y="3"
                        width="7"
                        height="7"/>

                    <rect
                        x="14"
                        y="3"
                        width="7"
                        height="7"/>

                    <rect
                        x="3"
                        y="14"
                        width="7"
                        height="7"/>

                    <rect
                        x="14"
                        y="14"
                        width="7"
                        height="7"/>

                </svg>

                Dashboard

            </a>

            <!-- INVENTORY -->
            <a href="{{ route('admin.inventory') }}"
               class="{{ request()->is('admin/inventory*') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>

                </svg>

                Inventory

            </a>

            <!-- RECIPES -->
            <a href="{{ route('admin.recipes') }}"
               class="{{ request()->is('admin/recipes*') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <path d="M3 2h18"/>

                    <path d="M7 2v20"/>

                    <path d="M17 2v20"/>

                    <path d="M3 7h18"/>

                    <path d="M3 12h18"/>

                    <path d="M3 17h18"/>

                    <path d="M3 22h18"/>

                </svg>

                Recipes

            </a>

            <!-- FINANCE -->
            <a href="{{ route('admin.finance') }}"
               class="{{ request()->is('admin/finance*') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <line
                        x1="12"
                        y1="1"
                        x2="12"
                        y2="23"/>

                    <path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/>

                </svg>

                Finance

            </a>

            <!-- RESTOCK -->
            <a href="{{ route('admin.restock') }}"
               class="{{ request()->is('admin/restock*') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>

                    <polyline points="17 6 23 6 23 12"/>

                </svg>

                Restock

            </a>

            <!-- HR -->
            <a href="{{ route('admin.employees') }}"
               class="{{ request()->is('admin/employees*') ? 'active' : '' }}">

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>

                    <circle
                        cx="9"
                        cy="7"
                        r="4"/>

                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>

                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                </svg>

                HR

            </a>

            <!-- CUSTOMER -->
<!-- CUSTOMER -->
<a href="{{ route('admin.customers') }}"
   class="{{ request()->is('admin/customers*') ? 'active' : '' }}">

    <svg
        width="18"
        height="18"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round">

        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

        <circle
            cx="12"
            cy="7"
            r="4"/>

    </svg>

    Customer

</a>

        </nav>

        <!-- FOOTER -->
        <div class="sidebar-footer">

            <div class="sidebar-divider"></div>

            <form
                action="{{ route('logout') }}"
                method="POST">

                @csrf

                <button
                    type="submit"
                    class="logout-btn">

                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>

                        <polyline points="16 17 21 12 16 7"/>

                        <line
                            x1="21"
                            y1="12"
                            x2="9"
                            y2="12"/>

                    </svg>

                    Logout

                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN -->
    <div class="main">

        <main class="content">

            @yield('content')

        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>