<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Support\Slugger;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('statut', '');

        $articles = Article::query()
            ->with(['category', 'user'])
            ->withCount('comments')
            ->search($q)
            ->when($status === 'publie', fn ($query) => $query->where('is_published', true))
            ->when($status === 'brouillon', fn ($query) => $query->where('is_published', false))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.articles.index', compact('articles', 'q', 'status'));
    }

    public function create()
    {
        return view('admin.articles.create', [
            'article' => new Article(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = Slugger::unique(Article::class, $data['title']);
        $data['user_id'] = $request->user()->id;

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($this->validated($request));

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:180'],
            'category_id' => ['required', 'exists:categories,id'],
            'summary' => ['required', 'string', 'min:20', 'max:400'],
            'content' => ['required', 'string', 'min:50'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}