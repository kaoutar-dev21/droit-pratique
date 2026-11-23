<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('is_published', true),
        ])->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $articles = $category->articles()
            ->where('is_published', true)
            ->with(['category', 'user'])
            ->withCount('comments')
            ->latest()
            ->paginate(9);

        return view('categories.show', compact('category', 'articles'));
    }
}