<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('is_published', true),
        ])->orderBy('name')->get();

        $latest = Article::published()->with(['category', 'user'])->withCount('comments')->latest()->take(6)->get();
        $popular = Article::published()->with('category')->orderByDesc('views')->take(4)->get();

        $stats = [
            'articles' => Article::published()->count(),
            'domaines' => Category::count(),
            'membres' => User::count(),
        ];

        return view('home', compact('categories', 'latest', 'popular', 'stats'));
    }
}