<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administration') | Droit Pratique</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body class="admin">
@php
    $adminLinks = [
        ['admin.dashboard', 'Tableau de bord', '📊'],
        ['admin.articles.index', 'Articles', '📝'],
        ['admin.categories.index', 'Domaines', '🗂️'],
        ['admin.comments.index', 'Commentaires', '💬'],
        ['admin.users.index', 'Utilisateurs', '👥'],
    ];
@endphp

<div class="admin-shell">
    <aside class="admin-side">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">⚖️</span>
            <span class="brand-text">Droit<strong>Pratique</strong></span>
        </a>

        <div class="admin-label">Administration</div>
        <nav class="admin-nav">
            @foreach($adminLinks as [$name, $label, $icon])
                @if(\Illuminate\Support\Facades\Route::has($name))
                    @php
                        $pattern = $name === 'admin.dashboard' ? $name : \Illuminate\Support\Str::beforeLast($name, '.').'.*';
                    @endphp
                    <a href="{{ route($name) }}" class="{{ request()->routeIs($pattern) ? 'active' : '' }}">
                        <span>{{ $icon }}</span> {{ $label }}
                    </a>
                @endif
            @endforeach
            <a href="{{ route('home') }}" target="_blank" rel="noopener"><span>🌐</span> Voir le site</a>
        </nav>

        <div class="admin-side-foot">
            <div class="who">
                <span class="avatar">{{ auth()->user()->initials }}</span>
                <div>
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <small style="opacity:.6">Administrateur</small>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-gold btn-sm">Déconnexion</button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        <div class="admin-top">
            <div>
                <h1>@yield('heading', 'Administration')</h1>
                @hasSection('subheading')
                    <p class="sub">@yield('subheading')</p>
                @endif
            </div>
            <div>@yield('actions')</div>
        </div>

        @if(session('success'))
            <div class="flash flash-success" role="status">
                <span>{{ session('success') }}</span>
                <button type="button" class="flash-close" aria-label="Fermer">&times;</button>
            </div>
        @endif
        @if(session('error'))
            <div class="flash flash-error" role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" class="flash-close" aria-label="Fermer">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
</body>
</html>