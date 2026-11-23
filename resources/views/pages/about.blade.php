@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<section class="page-header">
    <div class="container">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a> <span>/</span> <span>À propos</span>
        </nav>
        <h1>À propos de Droit Pratique</h1>
        <p class="lead">Rendre l'information juridique accessible à tous.</p>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="prose">
            <h2>Notre mission</h2>
            <p>Droit Pratique est une plateforme d'information juridique conçue pour expliquer simplement les règles qui touchent notre quotidien. Notre approche est volontairement pratique : des explications claires, des étapes concrètes et des conseils utiles pour vos démarches.</p>

            <h2>Ce que vous y trouverez</h2>
            <ul>
                <li>Des guides rédigés dans un langage clair, sans jargon inutile.</li>
                <li>Quatre grands domaines : famille, travail, immobilier et consommation.</li>
                <li>Une recherche rapide pour retrouver l'information dont vous avez besoin.</li>
                <li>Un espace de commentaires pour poser vos questions et échanger.</li>
            </ul>

            <h2>Important à savoir</h2>
            <p>Les contenus publiés ont une vocation purement informative. Ils ne constituent pas un conseil juridique personnalisé et ne remplacent pas l'avis d'un avocat, d'un notaire ou de tout autre professionnel du droit. La loi évolue : vérifiez toujours les textes en vigueur avant d'agir.</p>
        </div>

        <div class="about-cards">
            <div class="card center-card"><span class="domain-icon">🎯</span><h3>Clarté</h3><p>Des explications simples et structurées.</p></div>
            <div class="card center-card"><span class="domain-icon">🧭</span><h3>Pratique</h3><p>Des étapes concrètes et des documents à prévoir.</p></div>
            <div class="card center-card"><span class="domain-icon">🤝</span><h3>Communauté</h3><p>Des échanges respectueux dans les commentaires.</p></div>
        </div>
    </div>
</section>
@endsection