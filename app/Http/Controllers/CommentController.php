<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        abort_unless($article->is_published, 404);

        $data = $request->validate([
            'body' => ['required', 'string', 'min:3', 'max:1000'],
        ]);

        $article->comments()->create([
            'user_id' => $request->user()->id,
            'body' => trim($data['body']),
        ]);

        return redirect()
            ->to(route('articles.show', $article->slug).'#commentaires')
            ->with('success', 'Votre commentaire a été publié.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $comment->user_id === $user->id, 403);

        $slug = $comment->article->slug;
        $comment->delete();

        return redirect()
            ->to(route('articles.show', $slug).'#commentaires')
            ->with('success', 'Le commentaire a été supprimé.');
    }
}