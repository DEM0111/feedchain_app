<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Super Admin Dashboard | {{ config('app.name', 'FeedChain') }}</title>

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
            overflow-x: hidden;
            color: #07172f;
            background: #f6f8fb;
            font-family: Figtree, Arial, sans-serif;
        }

        button,
        a {
            font: inherit;
        }

        .dashboard-shell {
            display: grid;
            min-height: 100vh;
            grid-template-columns: 358px 1fr;
            background: #f6f8fb;
            transition: grid-template-columns 220ms ease;
        }

        .dashboard-shell.sidebar-collapsed {
            grid-template-columns: 104px 1fr;
        }

        .sidebar {
            position: sticky;
            top: 0;
            display: flex;
            height: 100vh;
            flex-direction: column;
            overflow: hidden;
            background: #0d1729;
            padding: 32px 28px 28px;
            color: #ffffff;
        }

        .brand-row {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 62px;
        }

        .brand-mark {
            position: relative;
            display: inline-flex;
            width: 50px;
            height: 50px;
            flex: 0 0 50px;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #18a8e6;
            box-shadow: 0 16px 32px rgba(24, 168, 230, 0.32);
        }

        .brand-mark svg {
            width: 28px;
            height: 28px;
        }

        .brand-link-dot {
            position: absolute;
            right: -6px;
            bottom: -6px;
            display: inline-flex;
            width: 22px;
            height: 22px;
            align-items: center;
            justify-content: center;
            border: 3px solid #0d1729;
            border-radius: 999px;
            background: #ffffff;
            color: #18a8e6;
        }

        .brand-name {
            color: #ffffff;
            font-size: 26px;
            font-weight: 900;
            white-space: nowrap;
        }

        .sidebar-toggle {
            display: inline-flex;
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            border: 0;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.09);
            color: #dbeafe;
            cursor: pointer;
            transition: background 160ms ease, transform 160ms ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .sidebar-nav {
            display: grid;
            gap: 14px;
            margin-top: 50px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 18px;
            min-height: 55px;
            border-radius: 12px;
            padding: 0 19px;
            color: #9fb3d1;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            transition: background 160ms ease, color 160ms ease;
        }

        .nav-item svg {
            width: 23px;
            height: 23px;
            flex: 0 0 23px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #19a9e4;
            color: #ffffff;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(156, 176, 205, 0.14);
            padding-top: 30px;
        }

        .user-block {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .avatar {
            display: inline-flex;
            width: 50px;
            height: 50px;
            flex: 0 0 50px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #202a66;
            color: #8ea2ff;
            font-size: 20px;
            font-weight: 900;
        }

        .user-name {
            color: #ffffff;
            font-size: 18px;
            font-weight: 900;
            line-height: 1.15;
        }

        .user-office {
            margin-top: 4px;
            color: #71839f;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
        }

        .sign-out-button {
            display: flex;
            width: 100%;
            min-height: 41px;
            align-items: center;
            gap: 12px;
            border: 0;
            border-radius: 13px;
            background: #1d2a40;
            padding: 0 20px;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            transition: background 160ms ease;
        }

        .sign-out-button:hover {
            background: #26364f;
        }

        .sign-out-button svg {
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
        }

        .dashboard-shell.sidebar-collapsed .sidebar {
            padding-right: 22px;
            padding-left: 22px;
        }

        .dashboard-shell.sidebar-collapsed .brand-name,
        .dashboard-shell.sidebar-collapsed .nav-label,
        .dashboard-shell.sidebar-collapsed .user-details,
        .dashboard-shell.sidebar-collapsed .sign-out-label {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
        }

        .dashboard-shell.sidebar-collapsed .brand-row,
        .dashboard-shell.sidebar-collapsed .user-block {
            justify-content: center;
        }

        .dashboard-shell.sidebar-collapsed .sidebar-toggle {
            position: absolute;
            top: 94px;
            left: 31px;
            margin: 0;
        }

        .dashboard-shell.sidebar-collapsed .sidebar-nav {
            margin-top: 86px;
        }

        .dashboard-shell.sidebar-collapsed .nav-item,
        .dashboard-shell.sidebar-collapsed .sign-out-button {
            justify-content: center;
            padding: 0;
        }

        .main-content {
            min-width: 0;
            padding: 51px 40px 76px;
        }

        .dashboard-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
        }

        .title-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
        }

        .dashboard-title {
            margin: 0;
            color: #07172f;
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -0.01em;
        }

        .secure-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 999px;
            background: #ccfbdf;
            padding: 12px 14px;
            color: #009a60;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .secure-pill svg {
            width: 15px;
            height: 15px;
        }

        .dashboard-subtitle {
            margin: 5px 0 0;
            color: #536783;
            font-size: 18px;
        }

        .date-card {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-height: 48px;
            border: 1px solid #d9e2ec;
            border-radius: 14px;
            background: #ffffff;
            padding: 0 22px;
            color: #263c5c;
            font-size: 18px;
            font-weight: 900;
            box-shadow: 0 3px 8px rgba(15, 23, 42, 0.08);
            white-space: nowrap;
        }

        .date-card svg {
            width: 19px;
            height: 19px;
            color: #0ea5e9;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(190px, 1fr));
            gap: 30px;
            margin-top: 42px;
        }

        .metric-card {
            display: flex;
            align-items: center;
            gap: 20px;
            min-height: 126px;
            border: 1px solid #e4eaf2;
            border-radius: 18px;
            background: #ffffff;
            padding: 24px 30px;
            box-shadow: 0 3px 7px rgba(15, 23, 42, 0.06);
        }

        .metric-icon {
            display: inline-flex;
            width: 60px;
            height: 60px;
            flex: 0 0 60px;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: #ffffff;
        }

        .metric-icon.blue {
            background: #19a9e4;
        }

        .metric-icon.green {
            background: #18bd85;
        }

        .metric-icon.purple {
            background: #6a62ec;
        }

        .metric-icon.orange {
            background: #f59b0b;
        }

        .metric-icon svg {
            width: 30px;
            height: 30px;
        }

        .metric-label {
            margin: 0;
            color: #536783;
            font-size: 18px;
            font-weight: 700;
        }

        .metric-value {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 12px;
            margin-top: 3px;
            color: #07172f;
            font-size: 32px;
            font-weight: 900;
            line-height: 1;
        }

        .metric-delta {
            color: #00aa70;
            font-size: 13px;
            font-weight: 900;
        }

        .batch-panel {
            overflow: hidden;
            margin-top: 40px;
            border: 1px solid #e4eaf2;
            border-radius: 48px;
            background: #ffffff;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.12);
        }

        .batch-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 42px 40px;
            border-bottom: 1px solid #eaf0f6;
        }

        .section-title-row {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .check-icon {
            display: inline-flex;
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            align-items: center;
            justify-content: center;
            border: 2px solid #14b987;
            border-radius: 999px;
            color: #14b987;
        }

        .batch-title {
            margin: 0;
            color: #07172f;
            font-size: 26px;
            font-weight: 900;
        }

        .batch-subtitle {
            margin: 4px 0 0 41px;
            color: #536783;
            font-size: 19px;
        }

        .view-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0ea5e9;
            font-size: 18px;
            font-weight: 900;
            text-decoration: none;
            white-space: nowrap;
        }

        .batch-card-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(230px, 1fr));
            gap: 26px;
            padding: 38px;
        }

        .batch-card {
            position: relative;
            min-height: 300px;
            border: 1px solid #e8eef5;
            border-radius: 50px;
            background: #ffffff;
            padding: 30px;
        }

        .batch-card.featured {
            border-color: #dff4ff;
            background: #f5fbff;
            box-shadow: inset 0 0 0 4px #eef9ff;
        }

        .batch-card-icon {
            display: inline-flex;
            width: 46px;
            height: 46px;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #ffffff;
            color: #19a9e4;
            box-shadow: 0 3px 8px rgba(15, 23, 42, 0.08);
        }

        .batch-card:not(.featured) .batch-card-icon {
            color: #9aabc3;
        }

        .mix-pill {
            position: absolute;
            top: 30px;
            right: 30px;
            border-radius: 999px;
            background: #cffadd;
            padding: 5px 11px;
            color: #00a56b;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .batch-code {
            margin: 20px 0 0;
            color: #8998b3;
            font-size: 14px;
            font-weight: 900;
        }

        .feed-name {
            margin: 12px 0 0;
            color: #07172f;
            font-size: 24px;
            font-weight: 900;
        }

        .batch-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 30px;
            color: #536783;
            font-size: 16px;
            font-weight: 900;
        }

        .batch-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .batch-amount {
            color: #07172f;
            font-size: 25px;
            font-weight: 900;
        }

        .progress-track {
            overflow: hidden;
            height: 10px;
            margin-top: 20px;
            border-radius: 999px;
            background: #e1e8f1;
        }

        .progress-fill {
            height: 100%;
            border-radius: inherit;
            background: #12b982;
        }

        .batch-footer {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            margin-top: 16px;
            color: #8a9ab4;
            font-size: 13px;
            font-weight: 900;
        }

        .exact-match {
            color: #00a56b;
        }

        @media (max-width: 1280px) {
            .metrics-grid {
                grid-template-columns: repeat(2, minmax(220px, 1fr));
            }

            .batch-card-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .dashboard-shell,
            .dashboard-shell.sidebar-collapsed {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                z-index: 50;
                width: 300px;
                transform: translateX(-100%);
                transition: transform 220ms ease;
            }

            .dashboard-shell.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .dashboard-shell.sidebar-collapsed .sidebar {
                padding: 32px 28px 28px;
            }

            .dashboard-shell.sidebar-collapsed .brand-name,
            .dashboard-shell.sidebar-collapsed .nav-label,
            .dashboard-shell.sidebar-collapsed .user-details,
            .dashboard-shell.sidebar-collapsed .sign-out-label {
                position: static;
                width: auto;
                height: auto;
                overflow: visible;
                clip: auto;
                white-space: normal;
            }

            .dashboard-shell.sidebar-collapsed .sidebar-toggle {
                position: static;
                margin-left: auto;
            }

            .dashboard-shell.sidebar-collapsed .sidebar-nav {
                margin-top: 50px;
            }

            .dashboard-shell.sidebar-collapsed .nav-item,
            .dashboard-shell.sidebar-collapsed .sign-out-button {
                justify-content: flex-start;
                padding: 0 19px;
            }

            .mobile-menu-button {
                display: inline-flex;
            }

            .main-content {
                padding: 24px 18px 48px;
            }

            .dashboard-header {
                align-items: stretch;
                flex-direction: column;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .batch-panel {
                border-radius: 24px;
            }

            .batch-panel-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 28px 24px;
            }

            .batch-subtitle {
                margin-left: 0;
            }

            .batch-card-grid {
                padding: 20px;
            }

            .batch-card {
                border-radius: 28px;
            }
        }

        @media (min-width: 901px) {
            .mobile-menu-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    @php
        $initials = collect(explode(' ', Auth::user()->name ?? 'Head Office'))
            ->filter()
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->take(2)
            ->implode('');
    @endphp

    <div class="dashboard-shell" id="dashboardShell">
        <aside class="sidebar" aria-label="Main navigation">
            <div class="brand-row">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 7c0-2.2 1.8-4 4-4 1.7 0 3.1 1 3.7 2.5" />
                        <path d="M7 7c-2.2 0-4 1.8-4 4 0 1.7 1 3.1 2.5 3.7" />
                        <path d="M17 17c2.2 0 4-1.8 4-4 0-1.7-1-3.1-2.5-3.7" />
                        <path d="M17 17c0 2.2-1.8 4-4 4-1.7 0-3.1-1-3.7-2.5" />
                        <path d="M9 8l6 8M15 8l-6 8" />
                    </svg>
                    <span class="brand-link-dot">
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M10 13a5 5 0 0 0 7.1 0l2-2a5 5 0 0 0-7.1-7.1l-1.1 1.1" />
                            <path d="M14 11a5 5 0 0 0-7.1 0l-2 2A5 5 0 0 0 12 20.1l1.1-1.1" />
                        </svg>
                    </span>
                </span>
                <span class="brand-name">FeedChain</span>
                <button class="sidebar-toggle" type="button" id="sidebarToggle" aria-label="Toggle sidebar" aria-expanded="true">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('SAdashboard') }}" class="nav-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="7" height="7" rx="1" /><rect x="14" y="3" width="7" height="7" rx="1" /><rect x="3" y="14" width="7" height="7" rx="1" /><rect x="14" y="14" width="7" height="7" rx="1" /></svg>
                    <span class="nav-label">Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m21 8-9-5-9 5 9 5 9-5Z" /><path d="M3 8v8l9 5 9-5V8" /><path d="M12 13v8" /></svg>
                    <span class="nav-label">Inventory Module</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18" /><path d="M5 21V8l5 3V8l5 3V4h4v17" /></svg>
                    <span class="nav-label">Production Module</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 17h4V5H2v12h3" /><path d="M14 17h2m3 0h3v-5l-3-4h-5" /><circle cx="7.5" cy="17.5" r="2.5" /><circle cx="18.5" cy="17.5" r="2.5" /></svg>
                    <span class="nav-label">Distribution Module</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2v20" /><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6" /></svg>
                    <span class="nav-label">Customer Sales</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M8 2h8l4 4v16H4V2h4Z" /><path d="M14 2v6h6" /><path d="m9 15 2 2 4-5" /></svg>
                    <span class="nav-label">Descriptive Analysis</span>
                </a>
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M4 19V5" /><path d="M9 19V9" /><path d="M14 19V3" /><path d="M19 19v-7" /><path d="M3 21h18" /></svg>
                    <span class="nav-label">BI Dashboard</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-block">
                    <span class="avatar">{{ $initials ?: 'HO' }}</span>
                    <div class="user-details">
                        <div class="user-name">Management</div>
                        <div class="user-office">HEAD OFFICE</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sign-out-button">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="m16 17 5-5-5-5" /><path d="M21 12H9" /></svg>
                        <span class="sign-out-label">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <button class="sidebar-toggle mobile-menu-button" type="button" id="mobileSidebarToggle" aria-label="Open sidebar">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <header class="dashboard-header">
                <div>
                    <div class="title-row">
                        <h1 class="dashboard-title">DASHBOARD</h1>
                        <span class="secure-pill">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" /><path d="m9 12 2 2 4-4" /></svg>
                            Secure Account
                        </span>
                    </div>
                    <p class="dashboard-subtitle">Managing Aquatic Feeds Supply Chain</p>
                </div>

                <div class="date-card">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M8 2v4M16 2v4M3 10h18" /><rect x="3" y="4" width="18" height="18" rx="2" /></svg>
                    {{ now()->format('n/j/Y') }}
                </div>
            </header>

            <section class="metrics-grid" aria-label="Dashboard metrics">
                <article class="metric-card">
                    <span class="metric-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m21 8-9-5-9 5 9 5 9-5Z" /><path d="M3 8v8l9 5 9-5V8" /><path d="M12 13v8" /></svg>
                    </span>
                    <div>
                        <p class="metric-label">Total Produced</p>
                        <div class="metric-value">1,075 Sks <span class="metric-delta">+12%</span></div>
                    </div>
                </article>

                <article class="metric-card">
                    <span class="metric-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 17h4V5H2v12h3" /><path d="M14 17h2m3 0h3v-5l-3-4h-5" /><circle cx="7.5" cy="17.5" r="2.5" /><circle cx="18.5" cy="17.5" r="2.5" /></svg>
                    </span>
                    <div>
                        <p class="metric-label">Fulfillment</p>
                        <div class="metric-value">4 Orders <span class="metric-delta">+5%</span></div>
                    </div>
                </article>

                <article class="metric-card">
                    <span class="metric-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="7" y="3" width="10" height="18" rx="2" /><path d="M9 7h6M9 11h6M9 15h4" /><path d="M10 3h4" /></svg>
                    </span>
                    <div>
                        <p class="metric-label">Finished Stock</p>
                        <div class="metric-value">740 Sks</div>
                    </div>
                </article>

                <article class="metric-card">
                    <span class="metric-icon orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M16 21v-2a4 4 0 0 0-8 0v2" /><circle cx="12" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>
                    </span>
                    <div>
                        <p class="metric-label">Market Reach</p>
                        <div class="metric-value">4 Farms</div>
                    </div>
                </article>
            </section>

            <section class="batch-panel">
                <div class="batch-panel-header">
                    <div>
                        <div class="section-title-row">
                            <span class="check-icon">
                                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 12 4 4 8-8" /></svg>
                            </span>
                            <h2 class="batch-title">Latest Batch Performance</h2>
                        </div>
                        <p class="batch-subtitle">Metrics for the last 3 individual production runs</p>
                    </div>

                    <a href="#" class="view-link">
                        View All Batches
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m9 18 6-6-6-6" /></svg>
                    </a>
                </div>

                <div class="batch-card-grid">
                    <article class="batch-card featured">
                        <span class="batch-card-icon">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18" /><path d="M5 21V8l5 3V8l5 3V4h4v17" /></svg>
                        </span>
                        <span class="mix-pill">Optimal Mix</span>
                        <p class="batch-code">P24-0415-01</p>
                        <h3 class="feed-name">Starter Feed (S1)</h3>
                        <div class="batch-meta">
                            <span class="batch-date">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg>
                                Apr 15
                            </span>
                            <span class="batch-amount">50 Sks</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width: 50%;"></div></div>
                        <div class="batch-footer">
                            <span>Target: 100 Sks</span>
                            <span class="exact-match">Exact Match</span>
                        </div>
                    </article>

                    <article class="batch-card">
                        <span class="batch-card-icon">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18" /><path d="M5 21V8l5 3V8l5 3V4h4v17" /></svg>
                        </span>
                        <span class="mix-pill">Optimal Mix</span>
                        <p class="batch-code">P24-0415-02</p>
                        <h3 class="feed-name">Grower Feed (G1)</h3>
                        <div class="batch-meta">
                            <span class="batch-date">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg>
                                Apr 15
                            </span>
                            <span class="batch-amount">75 Sks</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width: 75%;"></div></div>
                        <div class="batch-footer">
                            <span>Target: 100 Sks</span>
                            <span class="exact-match">Exact Match</span>
                        </div>
                    </article>

                    <article class="batch-card">
                        <span class="batch-card-icon">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18" /><path d="M5 21V8l5 3V8l5 3V4h4v17" /></svg>
                        </span>
                        <span class="mix-pill">Optimal Mix</span>
                        <p class="batch-code">P24-0415-03</p>
                        <h3 class="feed-name">Mash Feed (M1)</h3>
                        <div class="batch-meta">
                            <span class="batch-date">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg>
                                Apr 15
                            </span>
                            <span class="batch-amount">40 Sks</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width: 40%;"></div></div>
                        <div class="batch-footer">
                            <span>Target: 100 Sks</span>
                            <span class="exact-match">Exact Match</span>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>

    <script>
        const dashboardShell = document.getElementById('dashboardShell');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const storedSidebarState = localStorage.getItem('superAdminSidebarCollapsed');

        if (storedSidebarState === 'true') {
            dashboardShell.classList.add('sidebar-collapsed');
            sidebarToggle?.setAttribute('aria-expanded', 'false');
        }

        sidebarToggle?.addEventListener('click', () => {
            if (window.matchMedia('(max-width: 900px)').matches) {
                dashboardShell.classList.toggle('sidebar-open');
                return;
            }

            const isCollapsed = dashboardShell.classList.toggle('sidebar-collapsed');
            localStorage.setItem('superAdminSidebarCollapsed', isCollapsed ? 'true' : 'false');
            sidebarToggle.setAttribute('aria-expanded', isCollapsed ? 'false' : 'true');
        });

        mobileSidebarToggle?.addEventListener('click', () => {
            dashboardShell.classList.add('sidebar-open');
        });

        document.addEventListener('click', (event) => {
            if (!window.matchMedia('(max-width: 900px)').matches || !dashboardShell.classList.contains('sidebar-open')) {
                return;
            }

            const sidebar = document.querySelector('.sidebar');

            if (sidebar?.contains(event.target) || mobileSidebarToggle?.contains(event.target)) {
                return;
            }

            dashboardShell.classList.remove('sidebar-open');
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                dashboardShell.classList.remove('sidebar-open');
            }
        });
    </script>
</body>
</html>
