@extends('layouts.admin')

@section('title', 'Commentaires')

@section('content')
<style>
    .ap-toolbar{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;margin-bottom:1.2rem}
    .ap-filters{display:flex;flex-wrap:wrap;gap:.5rem;flex:1}
    .ap-filters input{padding:.6rem .8rem;border:1px solid #d8dde6;border-radius:8px;font:inherit;background:#fff;min-width:220px;flex:1}
    .ap-btn{display:inline-block;padding:.6rem 1.1rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-light{background:#eef1f6;color:#0a1f44}
    .ap-btn-sm{padding:.35rem .7rem;font-size:.85rem}
    .ap-btn-danger{background:#fdecea;color:#b3261e}
    .ap-wrap{background:#fff;border:1px solid #e4e8ef;border-radius:12px;overflow-x:auto}
    .ap-table{width:100%;border-collapse:collapse;min-width:720px}
    .ap-table th,.ap-table td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid #eef1f6;vertical-align:top}
    .ap-table th{font-size:.8rem;text-transform:uppercase;letter-spacing:.04em;color:#5a6577;background:#f7f9fc}
    .ap-table tr:last-child td{border-bottom:0}
    .ap-user{font-weight:600;color:#0a1f44}
    .ap-body{max-width:420px;line-height:1.5}
    .ap-empty{padding:2.5rem 1rem;text-align:center;color:#5a6577}
    .ap-count{margin:0 0 .8rem;color:#5a6577}
    .ap-actions{display:flex;gap:.4rem;flex-wrap:wrap}
</style>

<div class="ap-toolbar">
    <form method="GET" action="{{ route('admin.comments.index') }}" class="ap-filters">
        <input type="search" name="q" value="{{ $q }}" placeholder="Rechercher un commentaire ou un auteur...">
        <button type="submit" class="ap-btn ap-btn-light">Filtrer</button>
        @if($q !== '')
            <a href="{{ route('admin.comments.index') }}" class="ap-btn ap-btn-light">Réinitialiser</a>
        @endif
    </form>
</div>

<p class="ap-count">{{ $comments->total() }} {{ $comments->total() > 1 ? 'commentaires' : 'commentaire' }}</p>

<div class="ap-wrap">
    @if($comments->isEmpty())
        <div class="ap-empty">Aucun commentaire.</div>
    @else
        <table class="ap-table">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Commentaire</th>
                    <th>Article</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td class="ap-user">{{ $comment->user->name }}</td>
                        <td class="ap-body">{{ \Illuminate\Support\Str::limit($comment->body, 160) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($comment->article->title, 40) }}</td>
                        <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="ap-actions">
                                <a href="{{ route('articles.show', $comment->article->slug) }}#commentaire-{{ $comment->id }}" target="_blank" class="ap-btn ap-btn-light ap-btn-sm">Voir</a>
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" data-confirm="Supprimer ce commentaire ?">
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

<div style="margin-top:1.2rem">{{ $comments->links() }}</div>
@endsection