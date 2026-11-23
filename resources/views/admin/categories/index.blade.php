@extends('layouts.admin')

@section('title', 'Domaines')

@section('content')
<style>
    .ap-toolbar{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;justify-content:space-between;margin-bottom:1.2rem}
    .ap-btn{display:inline-block;padding:.6rem 1.1rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-gold{background:#c9a227;color:#0a1f44}
    .ap-btn-sm{padding:.35rem .7rem;font-size:.85rem}
    .ap-btn-danger{background:#fdecea;color:#b3261e}
    .ap-wrap{background:#fff;border:1px solid #e4e8ef;border-radius:12px;overflow-x:auto}
    .ap-table{width:100%;border-collapse:collapse;min-width:620px}
    .ap-table th,.ap-table td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid #eef1f6;vertical-align:middle}
    .ap-table th{font-size:.8rem;text-transform:uppercase;letter-spacing:.04em;color:#5a6577;background:#f7f9fc}
    .ap-table tr:last-child td{border-bottom:0}
    .ap-title{font-weight:600;color:#0a1f44}
    .ap-actions{display:flex;gap:.4rem;flex-wrap:wrap}
    .ap-icon{font-size:1.4rem}
    .ap-empty{padding:2.5rem 1rem;text-align:center;color:#5a6577}
    .ap-alert-error{background:#fdecea;color:#b3261e;padding:.8rem 1rem;border-radius:8px;margin-bottom:1rem}
</style>

@if(session('error'))
    <div class="ap-alert-error">{{ session('error') }}</div>
@endif

<div class="ap-toolbar">
    <span>{{ $categories->count() }} {{ $categories->count() > 1 ? 'domaines' : 'domaine' }}</span>
    <a href="{{ route('admin.categories.create') }}" class="ap-btn ap-btn-gold">+ Nouveau domaine</a>
</div>

<div class="ap-wrap">
    @if($categories->isEmpty())
        <div class="ap-empty">Aucun domaine.</div>
    @else
        <table class="ap-table">
            <thead>
                <tr>
                    <th>Icône</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Articles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="ap-icon">{{ $category->icon ?: '⚖️' }}</td>
                        <td class="ap-title">{{ $category->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit((string) $category->description, 70) }}</td>
                        <td>{{ $category->articles_count }}</td>
                        <td>
                            <div class="ap-actions">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="ap-btn ap-btn-sm">Modifier</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" data-confirm="Supprimer ce domaine ?">
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
@endsection