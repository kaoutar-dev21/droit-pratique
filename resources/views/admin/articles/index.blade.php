@extends('layouts.admin')

@section('title', 'Articles')

@section('content')
<style>
    .ap-toolbar{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;justify-content:space-between;margin-bottom:1.2rem}
    .ap-filters{display:flex;flex-wrap:wrap;gap:.5rem;flex:1}
    .ap-filters input,.ap-filters select{padding:.6rem .8rem;border:1px solid #d8dde6;border-radius:8px;font:inherit;background:#fff}
    .ap-filters input{min-width:220px;flex:1}
    .ap-btn{display:inline-block;padding:.6rem 1.1rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-gold{background:#c9a227;color:#0a1f44}
    .ap-btn-light{background:#eef1f6;color:#0a1f44}
    .ap-btn-sm{padding:.35rem .7rem;font-size:.85rem}
    .ap-btn-danger{background:#fdecea;color:#b3261e}
    .ap-wrap{background:#fff;border:1px solid #e4e8ef;border-radius:12px;overflow-x:auto}
    .ap-table{width:100%;border-collapse:collapse;min-width:720px}
    .ap-table th,.ap-table td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid #eef1f6;vertical-align:middle}
    .ap-table th{font-size:.8rem;text-transform:uppercase;letter-spacing:.04em;color:#5a6577;background:#f7f9fc}
    .ap-table tr:last-child td{border-bottom:0}
    .ap-title{font-weight:600;color:#0a1f44}
    .ap-badge{display:inline-block;padding:.2rem .6rem;border-radius:999px;font-size:.78rem;font-weight:600}
    .ap-ok{background:#e6f4ea;color:#1e7a3c}
    .ap-draft{background:#fff4d6;color:#8a6d00}
    .ap-actions{display:flex;gap:.4rem;flex-wrap:wrap}
    .ap-empty{padding:2.5rem 1rem;text-align:center;color:#5a6577}
    .ap-count{margin:0 0 .8rem;color:#5a6577}
</style>

<div class="ap-toolbar">
    <form method="GET" action="{{ route('admin.articles.index') }}" class="ap-filters">
        <input type="search" name="q" value="{{ $q }}" placeholder="Rechercher un article...">
        <select name="statut">
            <option value="">Tous les statuts</option>
            <option value="publie" @selected($status === 'publie')>Publiés</option>
            <option value="brouillon" @selected($status === 'brouillon')>Brouillons</option>
        </select>
        <button type="submit" class="ap-btn ap-btn-light">Filtrer</button>
        @if($q !== '' || $status !== '')
            <a href="{{ route('admin.articles.index') }}" class="ap-btn ap-btn-light">Réinitialiser</a>
        @endif
    </form>
    <a href="{{ route('admin.articles.create') }}" class="ap-btn ap-btn-gold">+ Nouvel article</a>
</div>

<p class="ap-count">{{ $articles->total() }} {{ $articles->total() > 1 ? 'articles' : 'article' }}</p>

<div class="ap-wrap">
    @if($articles->isEmpty())
        <div class="ap-empty">Aucun article trouvé.</div>
    @else
        <table class="ap-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Domaine</th>
                    <th>Statut</th>
                    <th>Vues</th>
                    <th>Comm.</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td class="ap-title">{{ \Illuminate\Support\Str::limit($article->title, 60) }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            @if($article->is_published)
                                <span class="ap-badge ap-ok">Publié</span>
                            @else
                                <span class="ap-badge ap-draft">Brouillon</span>
                            @endif
                        </td>
                        <td>{{ $article->views }}</td>
                        <td>{{ $article->comments_count }}</td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="ap-actions">
                                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="ap-btn ap-btn-light ap-btn-sm">Voir</a>
                                <a href="{{ route('admin.articles.edit', $article) }}" class="ap-btn ap-btn-sm">Modifier</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" data-confirm="Supprimer cet article ?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ap-btn ap-btn-danger ap-btn-sm">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div style="margin-top:1.2rem">{{ $articles->links() }}</div>
@endsection