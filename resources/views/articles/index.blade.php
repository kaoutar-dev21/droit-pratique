@extends('layouts.app')

@section('title', 'Articles juridiques')

@section('content')
<section class="page-header">
    <div class="container">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a> <span>/</span> <span>Articles</span>
        </nav>
        <h1>Articles juridiques</h1>
        <p class="lead">Recherchez un sujet ou filtrez par domaine pour trouver le guide qu'il vous faut.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form action="{{ route('articles.index') }}" method="GET" class="filter-bar" role="search">
            <input type="search" name="q" value="{{ $q }}" placeholder="Rechercher un article..." aria-label="Rechercher">
            <select name="categorie" aria-label="Filtrer par domaine">
                <option value="">Tous les domaines</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected($categorySlug === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
            @if($q !== '' || $categorySlug !== '')
                <a href="{{ route('articles.index') }}" class="btn btn-ghost-dark">Réinitialiser</a>
            @endif
        </form>

        <p class="result-count">
            {{ $articles->total() }} {{ $articles->total() > 1 ? 'résultats' : 'résultat' }}
            @if($q !== '') pour « {{ $q }} » @endif
        </p>

        @if($articles->isEmpty())
            <div class="empty-state">
                <span>🔍</span>
                <h3>Aucun article trouvé</h3>
                <p>Essayez avec d'autres mots-clés ou parcourez nos domaines juridiques.</p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Voir les domaines</a>
            </div>
        @else
            <div class="grid grid-3">
                @foreach($articles as $article)
                    @include('partials.article-card', ['article' => $article])
                @endforeach
            </div>

            {{ $articles->links() }}
        @endif
    </div>
</section>
@endsection