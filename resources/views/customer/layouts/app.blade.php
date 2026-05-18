<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>

        @yield('title', '404 Coffee')

    </title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/customer/app.css') }}">

    <!-- PAGE CSS -->
    @stack('styles')

</head>

<body>

    <!-- =========================================
         NAVBAR
    ========================================== -->

    <nav class="customer-navbar">

        <div class="navbar-container">

            <!-- LEFT -->
            <div class="navbar-left">

                <!-- LOGO -->
                <a href="{{ route('customer.home') }}"
                   class="navbar-logo">

                    <i class="fa-solid fa-mug-hot"></i>

                    <span>
                        404.Coffee
                    </span>

                </a>

                <!-- NAVIGATION -->
                <div class="navbar-links">

                    <a href="{{ route('customer.home') }}"
                       class="nav-link">

                        Home

                    </a>

                    <a href="{{ route('customer.menu') }}"
   class="nav-link">

    Menu

</a>

                    <a href="#"
                       class="nav-link">

                        Orders

                    </a>

                    <a href="#"
                       class="nav-link">

                        Profile

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="navbar-right">

                <!-- USER -->
                <div class="navbar-user">

                    <div class="user-avatar">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div class="user-info">

                        <span class="user-label">

                            Signed in as

                        </span>

                        <strong>

                            {{ auth()->user()->name ?? 'Guest' }}

                        </strong>

                    </div>

                </div>

                <!-- LOGOUT -->
                @auth

                    <form action="{{ route('customer.logout') }}"
                          method="POST">

                        @csrf

                        <button type="submit"
                                class="logout-btn">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            Logout

                        </button>

                    </form>

                @endauth

            </div>

        </div>

    </nav>

    <!-- =========================================
         MAIN
    ========================================== -->

    <main class="customer-main">

        @yield('content')

    </main>

    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer class="customer-footer">

        <div class="footer-container">

            <!-- LEFT -->
            <div class="footer-left">

                <h3>
                    404.Coffee
                </h3>

                <p>
                    Modern coffee ordering and customer experience platform.
                </p>

            </div>

            <!-- RIGHT -->
            <div class="footer-right">

                <span>

                    © {{ date('Y') }} 404.Coffee

                </span>

                <p>

                    All rights reserved.

                </p>

            </div>

        </div>

    </footer>

</body>

</html>