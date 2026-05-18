<!-- SIDEBAR -->
<aside class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <h2>
            404.COFFEE
        </h2>

        <span>
            POS SYSTEM
        </span>

    </div>

    <!-- USER -->
    <div class="user-profile">

        <div class="user-avatar">

            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

        </div>

        <div class="user-info">

            <h4>
                {{ auth()->user()->name }}
            </h4>

            <p>
                Cashier
            </p>

        </div>

    </div>

    <!-- MENU -->
    <nav class="menu-list">

        <!-- ALL MENU -->
        <a href="{{ route('pos', ['category' => 'all']) }}"
           class="menu-item {{ (!$category || $category == 'all') ? 'active' : '' }}">

            <i class="fa-solid fa-border-all"></i>

            <span>
                All Menu
            </span>

        </a>

        <!-- COFFEE -->
        <a href="{{ route('pos', ['category' => 1]) }}"
           class="menu-item {{ $category == 1 ? 'active' : '' }}">

            <i class="fa-solid fa-mug-hot"></i>

            <span>
                Coffee
            </span>

        </a>

        <!-- DRINK -->
        <a href="{{ route('pos', ['category' => 2]) }}"
           class="menu-item {{ $category == 2 ? 'active' : '' }}">

            <i class="fa-solid fa-glass-water"></i>

            <span>
                Drink
            </span>

        </a>

        <!-- FOOD -->
        <a href="{{ route('pos', ['category' => 3]) }}"
           class="menu-item {{ $category == 3 ? 'active' : '' }}">

            <i class="fa-solid fa-burger"></i>

            <span>
                Food
            </span>

        </a>

    </nav>

    <!-- FOOTER -->
    <div class="sidebar-footer">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>