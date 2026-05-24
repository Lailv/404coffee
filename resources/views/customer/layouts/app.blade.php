<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', '404.Coffee')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/customer/app.css') }}">

    @stack('styles')

</head>

<body>

    <div class="ambient ambient-1"></div>
    <div class="ambient ambient-2"></div>

    {{-- NAVBAR --}}
    <header class="navbar" id="navbar">
        <div class="navbar-container">

            {{-- LOGO --}}
            <a href="{{ route('customer.home') }}" class="navbar-logo">
                <div class="logo-box">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <div class="logo-content">
                    <h2>404.Coffee</h2>
                    <span>Brewed Beyond Ordinary</span>
                </div>
            </a>

            {{-- NAV --}}
            <nav class="navbar-menu">
                <a href="{{ route('customer.home') }}"  class="nav-link {{ request()->routeIs('customer.home')  ? 'active' : '' }}">Home</a>
                <a href="{{ route('customer.menu') }}"  class="nav-link {{ request()->routeIs('customer.menu')  ? 'active' : '' }}">Menu</a>
                <a href="{{ route('customer.cart') }}"  class="nav-link {{ request()->routeIs('customer.cart')  ? 'active' : '' }}">Cart</a>
                <a href="{{ route('customer.about') }}" class="nav-link {{ request()->routeIs('customer.about') ? 'active' : '' }}">About</a>
            </nav>

            {{-- ACTIONS --}}
            <div class="navbar-actions">

                <button class="action-btn" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <a href="{{ route('customer.cart') }}" class="action-btn" aria-label="Cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>

                <div class="user-box">
                    <div class="user-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="user-detail">
                        <small>{{ auth()->check() ? 'Welcome back' : 'Guest' }}</small>
                        <strong>{{ auth()->user()->name ?? 'Guest' }}</strong>
                    </div>
                </div>

            </div>

            {{-- MOBILE TOGGLE --}}
            <button class="mobile-toggle" id="mobileToggle" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>

        </div>

        {{-- MOBILE DRAWER --}}
        <div class="mobile-drawer" id="mobileDrawer">
            <a href="{{ route('customer.home') }}"  class="drawer-link">Home</a>
            <a href="{{ route('customer.menu') }}"  class="drawer-link">Menu</a>
            <a href="{{ route('customer.cart') }}"  class="drawer-link">Cart</a>
            <a href="{{ route('customer.about') }}" class="drawer-link">About</a>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">

        <div class="footer-divider">
            <div class="divider-line"></div>
            <div class="divider-icon"><i class="fa-solid fa-mug-hot"></i></div>
            <div class="divider-line"></div>
        </div>

        <div class="footer-container">

            <div class="footer-brand">
                <h2>404.Coffee</h2>
                <p>Premium coffee experience crafted for those who know the difference. Every cup tells a story.</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Hours</h3>
                <span>Mon – Fri : 07:00 – 22:00</span>
                <span>Sat – Sun : 08:00 – 23:00</span>
                <span class="footer-open">Open Now</span>
            </div>

            <div class="footer-column">
                <h3>Contact</h3>
                <span>support@404coffee.com</span>
                <span>+62 812 0000 0000</span>
                <span>Jakarta, Indonesia</span>
            </div>

        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} 404.Coffee — All Rights Reserved.
        </div>

    </footer>

    <script>
        // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile menu
        const toggle = document.getElementById('mobileToggle');
        const drawer = document.getElementById('mobileDrawer');
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('active');
            drawer.classList.toggle('open');
        });
    </script>

</body>
</html>
