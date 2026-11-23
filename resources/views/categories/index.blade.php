@extends('layouts.app')

@section('title', 'Domaines juridiques')

@section('content')
<section class="page-header">
    <div class="container">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a> <span>/</span> <span>Domaines</span>
        </nav>
        <h1>Domaines juridiques</h1>
        <p class="lead">Choisissez le domaine qui correspond à votre situation.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-2">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="card domain-card domain-card-lg">
                    <span class="domain-icon">{{ $category->icon ?: '⚖️' }}</span>
                    <div>
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                        <span class="domain-count">{{ $category->articles_count }} {{ $category->articles_count > 1 ? 'articles' : 'article' }} →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection