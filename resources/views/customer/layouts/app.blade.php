<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', '404.Coffee')</title>

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- MAIN CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/customer/app.css') }}">

    @stack('styles')

</head>

<body>

    {{-- CURSOR GLOW --}}
    <div class="cursor-glow"></div>

    {{-- AMBIENT BACKGROUND --}}
    <div class="ambient ambient-1"></div>
    <div class="ambient ambient-2"></div>
    <div class="ambient ambient-3"></div>

    {{-- NAVBAR --}}
    <header class="navbar"
            id="navbar">

        <div class="navbar-container">

            {{-- LOGO --}}
            <a href="{{ route('customer.home') }}"
               class="navbar-logo">

                <div class="logo-box">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>

                <div class="logo-content">

                    <h2>404.Coffee</h2>

                    <span>
                        Brewed Beyond Ordinary
                    </span>

                </div>

            </a>

            {{-- NAVIGATION --}}
            <nav class="navbar-menu">

                <a href="{{ route('customer.home') }}"
                   class="nav-link {{ request()->routeIs('customer.home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('customer.menu') }}"
                   class="nav-link {{ request()->routeIs('customer.menu') ? 'active' : '' }}">
                    Menu
                </a>

                <a href="{{ route('customer.cart') }}"
                   class="nav-link {{ request()->routeIs('customer.cart') ? 'active' : '' }}">
                    Cart
                </a>

                <a href="{{ route('customer.about') }}"
                   class="nav-link {{ request()->routeIs('customer.about') ? 'active' : '' }}">
                    About
                </a>

            </nav>

            {{-- STATUS --}}
            <div class="navbar-status">

                <span class="status-dot"></span>

                <span>
                    Freshly Brewed Daily
                </span>

            </div>

            {{-- ACTIONS --}}
            <div class="navbar-actions">

                {{-- CART --}}
                <a href="{{ route('customer.cart') }}"
                   class="action-btn"
                   aria-label="Cart">

                    <i class="fa-solid fa-bag-shopping"></i>

                    @php
                        $cartCount = count(session('cart', []));
                    @endphp

                    @if($cartCount > 0)

                        <span class="cart-badge">
                            {{ $cartCount }}
                        </span>

                    @endif

                </a>

                {{-- USER --}}
                @auth

<a href="{{ route('customer.profile') }}"
   class="user-box">

    <div class="user-avatar">

        <i class="fa-solid fa-user"></i>

    </div>

    <div class="user-detail">

        <small>

            Welcome Back

        </small>

        <strong>

            {{ auth()->user()->name }}

        </strong>

    </div>

</a>

@else

<div class="user-box">

    <div class="user-avatar">

        <i class="fa-solid fa-user"></i>

    </div>

    <div class="user-detail">

        <small>

            Guest Mode

        </small>

        <strong>

            Guest User

        </strong>

    </div>

</div>

@endauth

                {{-- LOGOUT --}}
                @auth

                <form action="{{ route('customer.logout') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="logout-btn"
                            aria-label="Logout">

                        <i class="fa-solid fa-right-from-bracket"></i>

                    </button>

                </form>

                @endauth

            </div>

            {{-- MOBILE TOGGLE --}}
            <button class="mobile-toggle"
                    id="mobileToggle"
                    aria-label="Menu">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

        {{-- MOBILE DRAWER --}}
        <div class="mobile-drawer"
             id="mobileDrawer">

            <div class="drawer-content">

                <a href="{{ route('customer.home') }}"
                   class="drawer-link">

                    <i class="fa-solid fa-house"></i>

                    <span>
                        Home
                    </span>

                </a>

                <a href="{{ route('customer.menu') }}"
                   class="drawer-link">

                    <i class="fa-solid fa-mug-hot"></i>

                    <span>
                        Menu
                    </span>

                </a>

                <a href="{{ route('customer.cart') }}"
                   class="drawer-link">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <span>
                        Cart
                    </span>

                </a>

                <a href="{{ route('customer.about') }}"
                   class="drawer-link">

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        About
                    </span>

                </a>

            </div>

            {{-- DRAWER FOOTER --}}
            <div class="drawer-footer">

                <span>404.Coffee</span>

                <small>
                    Brewed Beyond Ordinary
                </small>

            </div>

        </div>

    </header>

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- TOP GRADIENT --}}
        <div class="top-gradient"></div>

        @yield('content')

    </main>

    {{-- SCROLL TOP --}}
    <button class="scroll-top"
            id="scrollTop">

        <i class="fa-solid fa-arrow-up"></i>

    </button>

    {{-- FOOTER --}}
    <footer class="footer">

        {{-- DIVIDER --}}
        <div class="footer-divider">

            <div class="divider-line"></div>

            <div class="divider-icon">
                <i class="fa-solid fa-mug-hot"></i>
            </div>

            <div class="divider-line"></div>

        </div>

        {{-- FOOTER CONTENT --}}
        <div class="footer-container">

            {{-- BRAND --}}
            <div class="footer-brand">

                <h2>404.Coffee</h2>

                <p>
                    Premium coffee experience crafted for those who know the
                    difference. Every cup tells a story and every sip creates
                    a memorable moment.
                </p>

                <div class="footer-socials">

                    <a href="#"
                       aria-label="Instagram">

                        <i class="fa-brands fa-instagram"></i>

                    </a>

                    <a href="#"
                       aria-label="Facebook">

                        <i class="fa-brands fa-facebook-f"></i>

                    </a>

                    <a href="#"
                       aria-label="TikTok">

                        <i class="fa-brands fa-tiktok"></i>

                    </a>

                    <a href="#"
                       aria-label="Twitter">

                        <i class="fa-brands fa-x-twitter"></i>

                    </a>

                </div>

            </div>

            {{-- OPENING HOURS --}}
            <div class="footer-column">

                <h3>Opening Hours</h3>

                <span>
                    Monday - Friday : 07:00 - 22:00
                </span>

                <span>
                    Saturday - Sunday : 08:00 - 23:00
                </span>

                <div class="footer-open">

                    <span class="dot"></span>

                    Open Now

                </div>

            </div>

            {{-- CONTACT --}}
            <div class="footer-column">

                <h3>Contact</h3>

                <span>
                    support@404coffee.com
                </span>

                <span>
                    +62 812 0000 0000
                </span>

                <span>
                    Jakarta, Indonesia
                </span>

            </div>

            {{-- NEWSLETTER --}}
            <div class="footer-column">

                <h3>Newsletter</h3>

                <p class="newsletter-text">
                    Get updates about our newest coffee
                    and special promotions.
                </p>

                <form class="newsletter-form">

                    <input type="email"
                           placeholder="Your email address">

                    <button type="submit">
                        Subscribe
                    </button>

                </form>

            </div>

        </div>

        {{-- FOOTER QUOTE --}}
        <div class="footer-quote">

            <p>
                “Coffee is more than a drink —
                it’s a small escape from reality.”
            </p>

        </div>

        {{-- FOOTER BOTTOM --}}
        <div class="footer-bottom">

            <span>
                © {{ date('Y') }} 404.Coffee —
                All Rights Reserved.
            </span>

            <div class="footer-links">

                <a href="#">
                    Privacy
                </a>

                <a href="#">
                    Terms
                </a>

                <a href="#">
                    Support
                </a>

            </div>

        </div>

    </footer>

    {{-- SCRIPT --}}
    <script>

        // NAVBAR SCROLL
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {

            navbar.classList.toggle(
                'scrolled',
                window.scrollY > 20
            );

        });

        // MOBILE MENU
        const toggle = document.getElementById('mobileToggle');
        const drawer = document.getElementById('mobileDrawer');

        toggle.addEventListener('click', () => {

            toggle.classList.toggle('active');
            drawer.classList.toggle('open');

        });

        // SCROLL TOP
        const scrollTopBtn =
            document.getElementById('scrollTop');

        window.addEventListener('scroll', () => {

            if (window.scrollY > 300) {

                scrollTopBtn.classList.add('show');

            } else {

                scrollTopBtn.classList.remove('show');

            }

        });

        scrollTopBtn.addEventListener('click', () => {

            window.scrollTo({

                top: 0,
                behavior: 'smooth'

            });

        });

        // CURSOR GLOW
        const glow =
            document.querySelector('.cursor-glow');

        document.addEventListener('mousemove', (e) => {

            glow.style.left =
                e.clientX + 'px';

            glow.style.top =
                e.clientY + 'px';

        });

        // REVEAL ANIMATION
        const revealItems = document.querySelectorAll(
            '.card, .footer-column, .footer-brand'
        );

        const revealObserver =
            new IntersectionObserver((entries) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('show');

                    }

                });

            }, {
                threshold: 0.1
            });

        revealItems.forEach(item => {

            revealObserver.observe(item);

        });

    </script>

@stack('scripts')

</body>
</html>