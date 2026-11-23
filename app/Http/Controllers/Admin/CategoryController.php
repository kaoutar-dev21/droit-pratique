<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\Slugger;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create', ['category' => new Category()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Slugger::unique(Category::class, $data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Domaine créé avec succès.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validated($request);
        $data['slug'] = Slugger::unique(Category::class, $data['name'], $category->id);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Domaine mis à jour.');
    }

    public function destroy(Category $category)
    {
        if ($category->articles()->exists()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer : ce domaine contient des articles.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Domaine supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:80'],
            'icon' => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string', 'max:300'],
        ]);
    }
}