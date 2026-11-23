<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Informations juridiques claires et pratiques') | Droit Pratique</title>
    <meta name="description" content="@yield('description', 'Droit Pratique : des guides juridiques clairs et des conseils concrets sur la famille, le travail, le logement et la consommation.')">
    <meta name="theme-color" content="#0a1f44">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    @stack('head')
</head>
<body>
<a href="#contenu" class="skip-link">Aller au contenu</a>

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="Droit Pratique - Accueil">
            <span class="brand-mark">⚖️</span>
            <span class="brand-text">Droit<strong>Pratique</strong></span>
        </a>

        <button type="button" class="nav-toggle" id="navToggle" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mainNav">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav" id="mainNav" aria-label="Navigation principale">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Domaines</a>
            <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Articles</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>

            <div class="nav-actions">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm">Administration</a>
                    @endif
                    <span class="user-chip" title="{{ auth()->user()->email }}">
                        <span class="avatar">{{ auth()->user()->initials }}</span>
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-gold btn-sm">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-gold btn-sm">Créer un compte</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

@if(session('success') || session('error'))
    <div class="container flash-zone">
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
    </div>
@endif

<main id="contenu">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-col footer-about">
            <a href="{{ route('home') }}" class="brand brand-light">
                <span class="brand-mark">⚖️</span>
                <span class="brand-text">Droit<strong>Pratique</strong></span>
            </a>
            <p>Des informations juridiques claires, des étapes concrètes et des conseils pratiques pour vos démarches du quotidien.</p>
        </div>
        <div class="footer-col">
            <h4>Navigation</h4>
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('categories.index') }}">Domaines juridiques</a></li>
                <li><a href="{{ route('articles.index') }}">Tous les articles</a></li>
                <li><a href="{{ route('about') }}">À propos</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Compte</h4>
            <ul>
                @auth
                    <li><span class="muted-light">Connecté : {{ auth()->user()->name }}</span></li>
                @else
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ route('register') }}">Inscription</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <div class="container footer-bottom">
        <p class="disclaimer-footer">Les informations publiées sur ce site sont fournies à titre informatif et ne remplacent pas le conseil d'un avocat ou d'un professionnel du droit.</p>
        <p>&copy; {{ date('Y') }} Droit Pratique. Tous droits réservés.</p>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
@stack('scripts')
</body>
</html>