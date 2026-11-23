<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $role = (string) $request->query('role', '');

        $users = User::query()
            ->withCount(['comments', 'articles'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->when(in_array($role, [User::ROLE_USER, User::ROLE_ADMIN], true), fn ($query) => $query->where('role', $role))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q', 'role'));
    }

    public function toggleRole(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $user->update([
            'role' => $user->isAdmin() ? User::ROLE_USER : User::ROLE_ADMIN,
        ]);

        return back()->with('success', 'Rôle mis à jour pour '.$user->name.'.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if ($user->articles()->exists()) {
            return back()->with('error', 'Impossible de supprimer : cet utilisateur a publié des articles.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }
}