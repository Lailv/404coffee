<!-- SIDEBAR NAVIGATION -->
<aside class="sidebar">

    <!-- USER -->
    <div class="user-profile">

        <i class="fa-solid fa-circle-user"></i>

        <span>
            {{ auth()->user()->name }}
        </span>

    </div>

    <!-- MENU -->
    <nav class="menu-list">

        <!-- ALL MENU -->
        <a href="{{ route('pos', ['category' => 'all']) }}"
           class="menu-item {{ (!$category || $category == 'all') ? 'active' : '' }}">

            <i class="fa-solid fa-border-all"></i>

            All Menu

        </a>

        <!-- COFFEE -->
        <a href="{{ route('pos', ['category' => 1]) }}"
           class="menu-item {{ $category == 1 ? 'active' : '' }}">

            <i class="fa-solid fa-mug-hot"></i>

            Coffee

        </a>

        <!-- DRINK -->
        <a href="{{ route('pos', ['category' => 2]) }}"
           class="menu-item {{ $category == 2 ? 'active' : '' }}">

            <i class="fa-solid fa-glass-water"></i>

            Drink

        </a>

        <!-- FOOD -->
        <a href="{{ route('pos', ['category' => 3]) }}"
           class="menu-item {{ $category == 3 ? 'active' : '' }}">

            <i class="fa-solid fa-burger"></i>

            Food

        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="sidebar-footer">

        <form
            action="{{ route('logout') }}"
            method="POST">

            @csrf

            <button
                type="submit"
                class="logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </button>

        </form>

    </div>

</aside>