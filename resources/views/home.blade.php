@extends('layouts.app')

@section('title', 'Informations juridiques claires et pratiques')

@section('content')
<section class="hero">
    <div class="container hero-inner">
        <span class="eyebrow">Plateforme d'information juridique</span>
        <h1>Comprenez vos droits.<br><span class="gold">Agissez avec confiance.</span></h1>
        <p class="lead">Des guides clairs, des étapes concrètes et des conseils pratiques pour vos démarches du quotidien : famille, travail, logement et consommation.</p>

        <form action="{{ route('articles.index') }}" method="GET" class="search-hero" role="search">
            <input type="search" name="q" placeholder="Rechercher : divorce, contrat de travail, bail..." aria-label="Rechercher un article">
            <button type="submit" class="btn btn-gold">Rechercher</button>
        </form>

        <ul class="hero-stats">
            <li><strong>{{ $stats['articles'] }}</strong><span>Articles</span></li>
            <li><strong>{{ $stats['domaines'] }}</strong><span>Domaines</span></li>
            <li><strong>{{ $stats['membres'] }}</strong><span>Membres</span></li>
        </ul>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow eyebrow-dark">Nos domaines</span>
            <h2>Trouvez rapidement l'information dont vous avez besoin</h2>
        </div>

        <div class="grid grid-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="card domain-card">
                    <span class="domain-icon">{{ $category->icon ?: '⚖️' }}</span>
                    <h3>{{ $category->name }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($category->description, 90) }}</p>
                    <span class="domain-count">{{ $category->articles_count }} {{ $category->articles_count > 1 ? 'articles' : 'article' }} →</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-head section-head-row">
            <div>
                <span class="eyebrow eyebrow-dark">À la une</span>
                <h2>Derniers articles</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="btn btn-outline-dark">Voir tous les articles</a>
        </div>

        @if($latest->isEmpty())
            <p class="empty">Aucun article n'a encore été publié.</p>
        @else
            <div class="grid grid-3">
                @foreach($latest as $article)
                    @include('partials.article-card', ['article' => $article])
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="section">
    <div class="container two-col">
        <div>
            <span class="eyebrow eyebrow-dark">Comment ça marche ?</span>
            <h2>Trois étapes simples</h2>
            <ol class="steps">
                <li>
                    <span class="step-num">1</span>
                    <div><h3>Cherchez</h3><p>Utilisez la recherche ou parcourez les domaines pour trouver votre sujet.</p></div>
                </li>
                <li>
                    <span class="step-num">2</span>
                    <div><h3>Comprenez</h3><p>Lisez des explications claires, sans jargon, avec les étapes à suivre.</p></div>
                </li>
                <li>
                    <span class="step-num">3</span>
                    <div><h3>Passez à l'action</h3><p>Réunissez vos documents, posez vos questions en commentaire et consultez un professionnel si besoin.</p></div>
                </li>
            </ol>
        </div>

        <aside class="popular-box">
            <h3>Les plus consultés</h3>
            <ul>
                @foreach($popular as $item)
                    <li>
                        <a href="{{ route('articles.show', $item->slug) }}">
                            <span class="popular-rank">{{ $loop->iteration }}</span>
                            <span class="popular-title">{{ $item->title }}</span>
                            <span class="popular-views">{{ $item->views }} vues</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <div>
            <h2>Rejoignez la communauté Droit Pratique</h2>
            <p>Créez un compte gratuit pour commenter les articles et poser vos questions.</p>
        </div>
        @guest
            <a href="{{ route('register') }}" class="btn btn-gold btn-lg">Créer mon compte</a>
        @else
            <a href="{{ route('articles.index') }}" class="btn btn-gold btn-lg">Lire les articles</a>
        @endguest
    </div>
</section>
@endsection