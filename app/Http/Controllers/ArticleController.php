<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $categorySlug = (string) $request->query('categorie', '');

        $articles = Article::query()
            ->where('is_published', true)
            ->with(['category', 'user'])
            ->withCount('comments')
            ->search($q)
            ->when($categorySlug !== '', fn ($query) => $query->whereHas(
                'category',
                fn ($c) => $c->where('slug', $categorySlug)
            ))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('articles.index', compact('articles', 'categories', 'q', 'categorySlug'));
    }

    public function show(Request $request, Article $article)
    {
        $isAdmin = (bool) $request->user()?->isAdmin();

        if (! $article->is_published && ! $isAdmin) {
            abort(404);
        }

        // Compte une seule vue par session
        $key = 'viewed_article_'.$article->id;
        if (! $request->session()->has($key)) {
            $article->timestamps = false;
            $article->increment('views');
            $article->timestamps = true;
            $request->session()->put($key, true);
        }

        $article->load(['category', 'user', 'comments.user']);

        $related = Article::published()
            ->where('category_id', $article->category_id)
            ->whereKeyNot($article->id)
            ->latest()
            ->take(3)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('articles.show', compact('article', 'related', 'categories'));
    }
}