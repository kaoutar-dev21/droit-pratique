<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'published' => Article::where('is_published', true)->count(),
            'drafts' => Article::where('is_published', false)->count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'comments' => Comment::count(),
            'views' => (int) Article::sum('views'),
        ];

        $latestArticles = Article::with('category')->latest()->take(5)->get();
        $latestComments = Comment::with(['user', 'article'])->latest()->take(5)->get();
        $topArticles = Article::orderByDesc('views')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestArticles', 'latestComments', 'topArticles'));
    }
}