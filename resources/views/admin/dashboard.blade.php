@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('heading', 'Tableau de bord')
@section('subheading', 'Vue d\'ensemble de la plateforme')

@section('actions')
    @if(\Illuminate\Support\Facades\Route::has('admin.articles.create'))
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">+ Nouvel article</a>
    @endif
@endsection

@section('content')
<div class="stat-grid">
    <div class="stat-card"><div class="label">Articles</div><div class="value">{{ $stats['articles'] }}</div><div class="hint">{{ $stats['published'] }} publiés · {{ $stats['drafts'] }} brouillons</div></div>
    <div class="stat-card"><div class="label">Domaines</div><div class="value">{{ $stats['categories'] }}</div><div class="hint">Catégories juridiques</div></div>
    <div class="stat-card"><div class="label">Utilisateurs</div><div class="value">{{ $stats['users'] }}</div><div class="hint">Comptes inscrits</div></div>
    <div class="stat-card"><div class="label">Commentaires</div><div class="value">{{ $stats['comments'] }}</div><div class="hint">Tous articles</div></div>
    <div class="stat-card"><div class="label">Vues totales</div><div class="value">{{ number_format($stats['views'], 0, ',', ' ') }}</div><div class="hint">Lectures cumulées</div></div>
</div>

<div class="panel-grid">
    <div class="panel">
        <div class="panel-head"><h2>Derniers articles</h2></div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Titre</th><th>Domaine</th><th>Statut</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($latestArticles as $article)
                    <tr>
                        <td><a class="t-title" href="{{ route('articles.show', $article->slug) }}" target="_blank" rel="noopener">{{ \Illuminate\Support\Str::limit($article->title, 48) }}</a></td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            @if($article->is_published)
                                <span class="badge badge-ok">Publié</span>
                            @else
                                <span class="badge badge-draft">Brouillon</span>
                            @endif
                        </td>
                        <td>{{ $article->created_at->translatedFormat('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Aucun article.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head"><h2>Les plus lus</h2></div>
        <ul class="list-plain">
            @forelse($topArticles as $item)
                <li>
                    <a href="{{ route('articles.show', $item->slug) }}" target="_blank" rel="noopener">{{ \Illuminate\Support\Str::limit($item->title, 38) }}</a>
                    <span class="num">{{ $item->views }} vues</span>
                </li>
            @empty
                <li class="empty">Aucune donnée.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="panel">
    <div class="panel-head"><h2>Derniers commentaires</h2></div>
    <ul class="list-plain">
        @forelse($latestComments as $comment)
            <li>
                <div>
                    <strong>{{ $comment->user->name }}</strong> sur
                    <a href="{{ route('articles.show', $comment->article->slug) }}#commentaires" target="_blank" rel="noopener">{{ \Illuminate\Support\Str::limit($comment->article->title, 40) }}</a>
                    <div style="color:#667085;font-size:.88rem">{{ \Illuminate\Support\Str::limit($comment->body, 110) }}</div>
                </div>
                <span class="num">{{ $comment->created_at->diffForHumans() }}</span>
            </li>
        @empty
            <li class="empty">Aucun commentaire.</li>
        @endforelse
    </ul>
</div>
@endsection