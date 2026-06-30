<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log in | {{ config('app.name', 'FeedChain') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        * {
            box-sizing: border-box;
            border-radius: 40px; 
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            font-family: Figtree, Arial, sans-serif;
            color: #0f172a;
            background:
                radial-gradient(circle at top left, rgba(125, 211, 252, 0.5), transparent 32rem),
                linear-gradient(135deg, #0f4c81 0%, #1d4ed8 48%, #38bdf8 100%);
        }

        .login-shell {
            overflow: hidden;
            width: 100%;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(125, 211, 252, 0.5), transparent 32rem),
                linear-gradient(135deg, #0f4c81 0%, #1d4ed8 48%, #38bdf8 100%);
        }

        .login-grid {
            display: grid;
            min-height: 100vh;
        }

        .login-brand {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
            
        }

        .login-mark {
            display: inline-flex;
            width: 3rem;
            height: 3rem;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.15);
            font-size: 1.25rem;
            font-weight: 900;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .login-copy {
            max-width: 24rem;
            margin-top: 2.5rem;
        }

        .login-eyebrow {
            margin: 0;
            color: #dbeafe;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .login-title {
            margin: 0.75rem 0 0;
            font-size: clamp(2.4rem, 8vw, 3.25rem);
            line-height: 1;
            font-weight: 900;
        }

        .login-description {
            margin: 1rem 0 0;
            color: #eff6ff;
            line-height: 1.7;
        }

        .login-highlights {
            display: grid;
            gap: 0.75rem;
            margin-top: 2.5rem;
            color: #eff6ff;
            font-size: 0.92rem;
        }

        .login-highlight {
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .login-panel {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(18px);
        }

        .login-form-wrap {
            width: 100%;
            max-width: 28rem;
            margin: 0 auto;
        }

        .login-heading {
            margin-bottom: 2rem;
        }

        .login-heading h2 {
            margin: 0;
            color: #020617;
            font-size: 2rem;
            font-weight: 900;
        }

        .login-heading p {
            margin: 0.5rem 0 0;
            color: #475569;
            font-size: 0.95rem;
        }

        .login-form {
            display: grid;
            gap: 1.25rem;
        }

        .login-field label {
            display: block;
            margin-bottom: 0.5rem;
            color: #1e293b;
            font-size: 0.9rem;
            font-weight: 800;
        }

        .login-input {
            width: 100%;
            border: 1px solid #bfdbfe;
            border-radius: 0.875rem;
            padding: 0.85rem 1rem;
            color: #0f172a;
            background: #ffffff;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        .login-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
            outline: none;
        }

        .login-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .login-remember {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #475569;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .login-remember input {
            width: 1rem;
            height: 1rem;
            accent-color: #2563eb;
        }

        .login-forgot {
            color: #1d4ed8;
            font-size: 0.9rem;
            font-weight: 800;
            text-decoration: none;
        }

        .login-forgot:hover {
            color: #1e3a8a;
        }

        .login-button {
            width: 100%;
            border: 0;
            border-radius: 0.875rem;
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            padding: 0.9rem 1rem;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.01em;
            box-shadow: 0 12px 26px rgba(37, 99, 235, 0.28);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.34);
        }

        .create-account-wrap {
            position: relative;
            display: grid;
            gap: 0.65rem;
        }

        .create-account-wrap p {
            margin: 0;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .create-account-button {
            width: 100%;
            border: 1px solid #bfdbfe;
            border-radius: 0.875rem;
            background: #ffffff;
            padding: 0.85rem 1rem;
            color: #1d4ed8;
            font-weight: 800;
            text-align: center;
            transition: border-color 160ms ease, box-shadow 160ms ease, transform 160ms ease;
        }

        .create-account-button:hover,
        .create-account-button:focus {
            border-color: #2563eb;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.14);
            outline: none;
            transform: translateY(-1px);
        }

        .account-choice-popover {
            display: none;
            position: absolute;
            left: 0;
            right: 0;
            bottom: calc(100% + 0.75rem);
            z-index: 20;
            border: 1px solid #bfdbfe;
            border-radius: 1rem;
            padding: 0.5rem;
            background: #ffffff;
            box-shadow: 0 20px 44px rgba(15, 23, 42, 0.18);
        }

        .account-choice-popover.is-open {
            display: grid;
            gap: 0.35rem;
        }

        .account-choice {
            display: block;
            border-radius: 0.75rem;
            padding: 0.85rem;
            color: #0f172a;
            text-decoration: none;
            transition: background 160ms ease;
        }

        .account-choice:hover,
        .account-choice:focus {
            background: #eff6ff;
            outline: none;
        }

        .account-choice span {
            display: block;
            font-size: 0.95rem;
            font-weight: 900;
        }

        .account-choice small {
            display: block;
            margin-top: 0.2rem;
            color: #64748b;
            line-height: 1.4;
        }

        @media (min-width: 768px) {
            .login-grid {
                grid-template-columns: 0.95fr 1.05fr;
            }

            .login-brand,
            .login-panel {
                padding: clamp(2.5rem, 6vw, 5rem);
            }

            .login-options {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>

    <div class="login-shell">
        <div class="login-grid">
            <div class="login-brand">
                <div>
                    <div class="login-mark">
                        <span>F</span>
                    </div>

                    <div class="login-copy">
                        <p class="login-eyebrow">FeedChain</p>
                        <h1 class="login-title">
                            Welcome back
                        </h1>
                        <p class="login-description">
                            Sign in to manage operations, inventory, production, and team activity from one place.
                        </p>
                    </div>
                </div>

                <div class="login-highlights">
                    <div class="login-highlight">
                        Secure access for administrators and production teams.
                    </div>
                    <div class="login-highlight">
                        Keep your feed supply workflow clear, fast, and organized.
                    </div>
                </div>
            </div>

            <div class="login-panel">
                <div class="login-form-wrap">
                    <div class="login-heading">
                        <h2>Log in</h2>
                        <p>Enter your account details to continue.</p>
                    </div>

                    <x-auth-session-status class="mb-5 rounded-xl bg-blue-50 px-4 py-3 text-sm font-medium text-blue-700" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf

                        <div class="login-field">
                            <label for="email">
                                {{ __('Email') }}
                            </label>
                            <input
                                id="email"
                                class="login-input"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                            >
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="login-field">
                            <label for="password">
                                {{ __('Password') }}
                            </label>
                            <input
                                id="password"
                                class="login-input"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            >
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="login-options">
                            <label for="remember_me" class="login-remember">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                >
                                <span>{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="login-forgot" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        
                        <div class="create-account-wrap">
                            <p>Don't have an account?</p>

                            <button type="button" class="create-account-button" id="createAccountButton" aria-expanded="false" aria-controls="accountChoicePopover">
                                Create account
                            </button>

                            <div class="account-choice-popover" id="accountChoicePopover">
                                <a href="{{ route('register', ['role' => 'production_manager']) }}" class="account-choice">
                                    <span>Production account</span>
                                    <small>Create access for production dashboard workflows.</small>
                                </a>

                                <a href="{{ route('register', ['role' => 'super_admin']) }}" class="account-choice">
                                    <span>Super admin account</span>
                                    <small>Create access for top-level administrator controls.</small>
                                </a>
                            </div>
                        </div>

                        <button type="submit" class="login-button">
                            {{ __('Log in') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const createAccountButton = document.getElementById('createAccountButton');
        const accountChoicePopover = document.getElementById('accountChoicePopover');

        createAccountButton?.addEventListener('click', () => {
            const isOpen = accountChoicePopover.classList.toggle('is-open');

            createAccountButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', (event) => {
            if (!createAccountButton || !accountChoicePopover) {
                return;
            }

            if (createAccountButton.contains(event.target) || accountChoicePopover.contains(event.target)) {
                return;
            }

            accountChoicePopover.classList.remove('is-open');
            createAccountButton.setAttribute('aria-expanded', 'false');
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape' || !createAccountButton || !accountChoicePopover) {
                return;
            }

            accountChoicePopover.classList.remove('is-open');
            createAccountButton.setAttribute('aria-expanded', 'false');
            createAccountButton.focus();
        });
    </script>
</body>
</html>
