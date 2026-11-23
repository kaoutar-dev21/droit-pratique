@extends('layouts.app')

@section('title', $category->name)
@section('description', \Illuminate\Support\Str::limit((string) $category->description, 150))

@section('content')
<section class="page-header">
    <div class="container">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a> <span>/</span>
            <a href="{{ route('categories.index') }}">Domaines</a> <span>/</span>
            <span>{{ $category->name }}</span>
        </nav>
        <h1>{{ $category->icon }} {{ $category->name }}</h1>
        @if($category->description)
            <p class="lead">{{ $category->description }}</p>
        @endif
    </div>
</section>

<section class="section">
    <div class="container">
        @if($articles->isEmpty())
            <div class="empty-state">
                <span>📄</span>
                <h3>Aucun article dans ce domaine pour le moment</h3>
                <p>De nouveaux guides seront bientôt publiés.</p>
                <a href="{{ route('articles.index') }}" class="btn btn-primary">Voir tous les articles</a>
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