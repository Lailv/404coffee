<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — 404 Coffee</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-wrap">

    <div class="card">

        <!-- HEADER -->
        <div class="card-header">
            <div class="card-brand">404.Coffee</div>
            <h1 class="card-title">Welcome back</h1>
            <p class="card-sub">Sign in to your account</p>
        </div>

        <!-- DIVIDER -->
        <div class="card-divider"></div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="error-alert">{{ $errors->first() }}</div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    required
                    autofocus>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required>
            </div>

            <button type="submit" class="login-btn">Sign In</button>

        </form>

    </div>

</div>

</body>
</html>
