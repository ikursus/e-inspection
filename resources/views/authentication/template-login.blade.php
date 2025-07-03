<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Fallback styles */
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #FDFDFC;
                color: #1b1b18;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dark body {
                background-color: #0a0a0a;
                color: #EDEDEC;
            }
            .login-container {
                width: 100%;
                max-width: 400px;
                padding: 2rem;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(26, 26, 0, 0.16);
            }
            .dark .login-container {
                background: #161615;
                border-color: #3E3E3A;
            }
            .form-group {
                margin-bottom: 1.5rem;
            }
            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                font-size: 0.875rem;
            }
            .form-input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e3e3e0;
                border-radius: 4px;
                font-size: 1rem;
                transition: border-color 0.15s ease-in-out;
            }
            .form-input:focus {
                outline: none;
                border-color: #FF750F;
                box-shadow: 0 0 0 3px rgba(255, 117, 15, 0.1);
            }
            .dark .form-input {
                background: #161615;
                border-color: #3E3E3A;
                color: #EDEDEC;
            }
            .btn {
                width: 100%;
                padding: 0.75rem;
                background: #FF750F;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 1rem;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.15s ease-in-out;
            }
            .btn:hover {
                background: #e6650d;
            }
            .btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }
            .text-center {
                text-align: center;
            }
            .text-sm {
                font-size: 0.875rem;
            }
            .text-gray {
                color: #706f6c;
            }
            .dark .text-gray {
                color: #A1A09A;
            }
            .link {
                color: #FF750F;
                text-decoration: none;
            }
            .link:hover {
                text-decoration: underline;
            }
            .alert {
                padding: 0.75rem;
                margin-bottom: 1rem;
                border-radius: 4px;
                font-size: 0.875rem;
            }
            .alert-error {
                background: #fef2f2;
                color: #dc2626;
                border: 1px solid #fecaca;
            }
            .dark .alert-error {
                background: #1f1415;
                color: #f87171;
                border-color: #3f1518;
            }
        </style>
    @endif
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <div class="text-center" style="margin-bottom: 2rem;">
            <h1 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; font-weight: 600;">
                Welcome Back
            </h1>
            <p class="text-sm text-gray" style="margin: 0;">
                Sign in to your account to continue
            </p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    id="email" 
                    class="form-input @error('email') is-invalid @enderror" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="Enter your email"
                />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    id="password" 
                    class="form-input"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <label for="remember_me" style="display: flex; align-items: center; font-weight: normal;">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        name="remember"
                        style="margin-right: 0.5rem;"
                    />
                    <span class="text-sm">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn">
                    Sign In
                </button>
            </div>

            <!-- Additional Links -->
            <div class="text-center">
                @if (Route::has('password.request'))
                    <a class="link text-sm" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                @if (Route::has('register'))
                    <div style="margin-top: 1rem;">
                        <span class="text-sm text-gray">Don't have an account? </span>
                        <a class="link text-sm" href="{{ route('register') }}">
                            Sign up
                        </a>
                    </div>
                @endif
            </div>
        </form>

        <!-- Back to Home -->
        <div class="text-center" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e3e3e0;">
            <a class="link text-sm" href="{{ url('/') }}">
                ← Back to Home
            </a>
        </div>
    </div>

    <!-- Dark mode toggle script (optional) -->
    <script>
        // Simple dark mode detection
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        
        // Listen for changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (e.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    </script>
</body>
</html>
