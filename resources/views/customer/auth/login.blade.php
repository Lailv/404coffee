<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Login — 404.Coffee
    </title>

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/customer/login.css') }}">

</head>

<body>

    {{-- AMBIENT --}}
    <div class="ambient ambient-1"></div>
    <div class="ambient ambient-2"></div>
    <div class="ambient ambient-3"></div>

    {{-- LOGIN --}}
    <div class="login-page">

        {{-- LEFT --}}
        <div class="login-showcase">

            <span class="showcase-badge">

                <span class="badge-dot"></span>

                Premium Coffee Experience

            </span>

            <h1>

                Brewed Beyond
                <em>Ordinary</em>

            </h1>

            <p>

                Experience premium handcrafted coffee,
                modern atmosphere, and a seamless
                digital cafe experience designed
                for creators and coffee lovers.

            </p>

            {{-- STATS --}}
            <div class="showcase-stats">

                <div class="showcase-stat">

                    <strong>
                        50+
                    </strong>

                    <span>
                        Premium Menu
                    </span>

                </div>

                <div class="showcase-stat">

                    <strong>
                        4.9★
                    </strong>

                    <span>
                        Customer Rating
                    </span>

                </div>

                <div class="showcase-stat">

                    <strong>
                        Daily
                    </strong>

                    <span>
                        Fresh Brewed
                    </span>

                </div>

            </div>

            {{-- ORB --}}
            <div class="showcase-orb-wrap">

                <div class="orb-ring ring-1"></div>
                <div class="orb-ring ring-2"></div>

                <div class="showcase-orb">

                    <span>
                        EST 2026
                    </span>

                    <h2>
                        404.Coffee
                    </h2>

                    <p>
                        Crafted With Passion
                    </p>

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="login-container">

            <div class="login-card">

                <div class="card-glow"></div>

                {{-- BRAND --}}
                <div class="login-brand">

                    <div class="brand-icon">

                        <i class="fa-solid fa-mug-hot"></i>

                    </div>

                    <div class="brand-content">

                        <h2>
                            404.Coffee
                        </h2>

                        <span>
                            Premium Coffee Experience
                        </span>

                    </div>

                </div>

                {{-- HEADER --}}
                <div class="login-header">

                    <h1>

                        Welcome Back

                    </h1>

                    <p>

                        Sign in to continue your
                        coffee experience.

                    </p>

                </div>

                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="error-alert">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <span>
                            {{ $errors->first() }}
                        </span>

                    </div>

                @endif

                {{-- FORM --}}
                <form method="POST"
                      action="{{ route('customer.login.submit') }}"
                      class="login-form">

                    @csrf

                    {{-- EMAIL --}}
                    <div class="input-group">

                        <label>
                            Email Address
                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-envelope"></i>

                            <input type="email"
                                   name="email"
                                   placeholder="you@example.com"
                                   value="{{ old('email') }}"
                                   required>

                        </div>

                    </div>

                    {{-- PASSWORD --}}
                    <div class="input-group">

                        <label>
                            Password
                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-lock"></i>

                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   required>

                        </div>

                    </div>

                    {{-- OPTIONS --}}
                    <div class="login-options">

                        <label class="remember-box">

                            <input type="checkbox">

                            <span>
                                Remember me
                            </span>

                        </label>

                        <a href="#"
                           class="forgot-link">

                            Forgot password?

                        </a>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                            class="login-btn">

                        Sign In

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>

                    {{-- DIVIDER --}}
                    <div class="login-divider">

                        <span>
                            OR CONTINUE WITH
                        </span>

                    </div>

                    {{-- GOOGLE --}}
                    <a href="{{ route('customer.google') }}"
                       class="google-btn">

                        <i class="fa-brands fa-google"></i>

                        Continue with Google

                    </a>

                </form>

            </div>

        </div>

    </div>

</body>
</html>