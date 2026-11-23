@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<style>
    .ap-toolbar{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;margin-bottom:1.2rem}
    .ap-filters{display:flex;flex-wrap:wrap;gap:.5rem;flex:1}
    .ap-filters input,.ap-filters select{padding:.6rem .8rem;border:1px solid #d8dde6;border-radius:8px;font:inherit;background:#fff}
    .ap-filters input{min-width:220px;flex:1}
    .ap-btn{display:inline-block;padding:.6rem 1.1rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-light{background:#eef1f6;color:#0a1f44}
    .ap-btn-sm{padding:.35rem .7rem;font-size:.85rem}
    .ap-btn-danger{background:#fdecea;color:#b3261e}
    .ap-wrap{background:#fff;border:1px solid #e4e8ef;border-radius:12px;overflow-x:auto}
    .ap-table{width:100%;border-collapse:collapse;min-width:720px}
    .ap-table th,.ap-table td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid #eef1f6;vertical-align:middle}
    .ap-table th{font-size:.8rem;text-transform:uppercase;letter-spacing:.04em;color:#5a6577;background:#f7f9fc}
    .ap-table tr:last-child td{border-bottom:0}
    .ap-user{display:flex;align-items:center;gap:.7rem}
    .ap-avatar{width:36px;height:36px;border-radius:50%;background:#0a1f44;color:#c9a227;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0}
    .ap-name{font-weight:600;color:#0a1f44}
    .ap-badge{display:inline-block;padding:.2rem .6rem;border-radius:999px;font-size:.78rem;font-weight:600}
    .ap-admin{background:#fff4d6;color:#8a6d00}
    .ap-simple{background:#eef1f6;color:#0a1f44}
    .ap-actions{display:flex;gap:.4rem;flex-wrap:wrap}
    .ap-empty{padding:2.5rem 1rem;text-align:center;color:#5a6577}
    .ap-count{margin:0 0 .8rem;color:#5a6577}
    .ap-alert-error{background:#fdecea;color:#b3261e;padding:.8rem 1rem;border-radius:8px;margin-bottom:1rem}
</style>

@if(session('error'))
    <div class="ap-alert-error">{{ session('error') }}</div>
@endif

<div class="ap-toolbar">
    <form method="GET" action="{{ route('admin.users.index') }}" class="ap-filters">
        <input type="search" name="q" value="{{ $q }}" placeholder="Rechercher par nom ou e-mail...">
        <select name="role">
            <option value="">Tous les rôles</option>
            <option value="user" @selected($role === 'user')>Utilisateurs</option>
            <option value="admin" @selected($role === 'admin')>Administrateurs</option>
        </select>
        <button type="submit" class="ap-btn ap-btn-light">Filtrer</button>
        @if($q !== '' || $role !== '')
            <a href="{{ route('admin.users.index') }}" class="ap-btn ap-btn-light">Réinitialiser</a>
        @endif
    </form>
</div>

<p class="ap-count">{{ $users->total() }} {{ $users->total() > 1 ? 'utilisateurs' : 'utilisateur' }}</p>

<div class="ap-wrap">
    @if($users->isEmpty())
        <div class="ap-empty">Aucun utilisateur trouvé.</div>
    @else
        <table class="ap-table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>E-mail</th>
                    <th>Rôle</th>
                    <th>Comm.</th>
                    <th>Inscrit le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="ap-user">
                                <span class="ap-avatar">{{ $user->initials }}</span>
                                <span class="ap-name">{{ $user->name }}@if($user->id === auth()->id()) (vous)@endif</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->isAdmin())
                                <span class="ap-badge ap-admin">Admin</span>
                            @else
                                <span class="ap-badge ap-simple">Utilisateur</span>
                            @endif
                        </td>
                        <td>{{ $user->comments_count }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($user->id !== auth()->id())
                                <div class="ap-actions">
                                    <form method="POST" action="{{ route('admin.users.role', $user) }}" data-confirm="{{ $user->isAdmin() ? 'Retirer le rôle admin ?' : 'Donner le rôle admin ?' }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="ap-btn ap-btn-light ap-btn-sm">{{ $user->isAdmin() ? 'Retirer admin' : 'Rendre admin' }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="Supprimer cet utilisateur ?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ap-btn ap-btn-danger ap-btn-sm">Supprimer</button>
                                    </form>
                                </div>
                            @else
                                <span style="color:#5a6577">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div style="margin-top:1.2rem">{{ $users->links() }}</div>
@endsection