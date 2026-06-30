@php
    $selectedRole = old('role', request('role', 'production_manager'));

    if (! in_array($selectedRole, ['production_manager', 'super_admin'], true)) {
        $selectedRole = 'production_manager';
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Account | {{ config('app.name', 'FeedChain') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        * {
            box-sizing: border-box;
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
                radial-gradient(circle at top left, rgba(191, 219, 254, 0.72), transparent 26rem),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.35), transparent 25rem),
                linear-gradient(135deg, #0f4c81 0%, #1d4ed8 52%, #38bdf8 100%);
        }

        .register-shell {
            display: grid;
            min-height: 100vh;
        }

        .register-brand {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
            color: #ffffff;
        }

        .register-mark {
            display: inline-flex;
            width: 3rem;
            height: 3rem;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.16);
            font-size: 1.25rem;
            font-weight: 900;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .register-copy {
            max-width: 28rem;
            margin-top: 2.5rem;
        }

        .register-eyebrow {
            margin: 0;
            color: #dbeafe;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .register-title {
            margin: 0.75rem 0 0;
            font-size: 2.6rem;
            line-height: 1;
            font-weight: 900;
        }

        .register-description {
            margin: 1rem 0 0;
            color: #eff6ff;
            line-height: 1.7;
        }

        .register-highlights {
            display: grid;
            gap: 0.75rem;
            margin-top: 2.5rem;
            color: #eff6ff;
            font-size: 0.92rem;
        }

        .register-highlight {
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .register-panel {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(18px);
        }

        .register-form-wrap {
            width: 100%;
            max-width: 32rem;
            margin: 0 auto;
        }

        .register-heading {
            margin-bottom: 1.5rem;
        }

        .register-heading h2 {
            margin: 0;
            color: #020617;
            font-size: 2rem;
            font-weight: 900;
        }

        .register-heading p {
            margin: 0.5rem 0 0;
            color: #475569;
            font-size: 0.95rem;
        }

        .register-form {
            display: grid;
            gap: 1.1rem;
        }

        .register-field label,
        .account-type-title {
            display: block;
            margin-bottom: 0.5rem;
            color: #1e293b;
            font-size: 0.9rem;
            font-weight: 800;
        }

        .register-input {
            width: 100%;
            border: 1px solid #bfdbfe;
            border-radius: 0.875rem;
            padding: 0.85rem 1rem;
            color: #0f172a;
            background: #ffffff;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        .register-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
            outline: none;
        }

        .account-type-grid {
            display: grid;
            gap: 0.75rem;
        }

        .account-type-card {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.75rem;
            align-items: start;
            border: 1px solid #bfdbfe;
            border-radius: 1rem;
            padding: 0.95rem;
            background: #ffffff;
            cursor: pointer;
            transition: border-color 160ms ease, box-shadow 160ms ease, transform 160ms ease;
        }

        .account-type-card:hover {
            transform: translateY(-1px);
            border-color: #2563eb;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.14);
        }

        .account-type-card input {
            width: 1rem;
            height: 1rem;
            margin-top: 0.2rem;
            accent-color: #2563eb;
        }

        .account-type-card span {
            display: block;
            color: #0f172a;
            font-weight: 900;
        }

        .account-type-card small {
            display: block;
            margin-top: 0.25rem;
            color: #64748b;
            line-height: 1.5;
        }

        .register-actions {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            margin-top: 0.25rem;
        }

        .register-login-link {
            color: #1d4ed8;
            font-size: 0.9rem;
            font-weight: 800;
            text-decoration: none;
        }

        .register-login-link:hover {
            color: #1e3a8a;
        }

        .register-button {
            width: 100%;
            border: 0;
            border-radius: 0.875rem;
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            padding: 0.9rem 1rem;
            color: #ffffff;
            font-weight: 800;
            box-shadow: 0 12px 26px rgba(37, 99, 235, 0.28);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .register-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.34);
        }

        @media (min-width: 768px) {
            .register-shell {
                grid-template-columns: 0.9fr 1.1fr;
            }

            .register-brand,
            .register-panel {
                padding: 4rem;
            }

            .account-type-grid {
                grid-template-columns: 1fr 1fr;
            }

            .register-actions {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .register-button {
                width: auto;
                min-width: 11rem;
            }
        }
    </style>
</head>
<body>
    <main class="register-shell">
        <section class="register-brand">
            <div>
                <div class="register-mark">
                    <span>F</span>
                </div>

                <div class="register-copy">
                    <p class="register-eyebrow">FeedChain</p>
                    <h1 class="register-title">Create your account</h1>
                    <p class="register-description">
                        Set up secure access for production teams or super administrators.
                    </p>
                </div>
            </div>

            <div class="register-highlights">
                <div class="register-highlight">Choose the account type before submitting the form.</div>
                <div class="register-highlight">New users are sent to the right dashboard after registration.</div>
            </div>
        </section>

        <section class="register-panel">
            <div class="register-form-wrap">
                <div class="register-heading">
                    <h2>Register</h2>
                    <p>Enter the account details to continue.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf

                    <div class="register-field">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" class="register-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Full name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="register-field">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" class="register-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <span class="account-type-title">Account type</span>
                        <div class="account-type-grid">
                            <label class="account-type-card">
                                <input type="radio" name="role" value="production_manager" @checked($selectedRole === 'production_manager')>
                                <span>
                                    Production account
                                    <small>Access production dashboard tools and workflow pages.</small>
                                </span>
                            </label>

                            <label class="account-type-card">
                                <input type="radio" name="role" value="super_admin" @checked($selectedRole === 'super_admin')>
                                <span>
                                    Super admin account
                                    <small>Access top-level dashboard controls and administration.</small>
                                </span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="register-field">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" class="register-input" type="password" name="password" required autocomplete="new-password" placeholder="Create a password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="register-field">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="register-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="register-actions">
                        <a class="register-login-link" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="register-button">
                            {{ __('Create account') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
