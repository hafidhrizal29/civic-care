<?php

namespace App\Http\Controllers;

use App\Models\ComplaintCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ComplaintCategory::withCount('complaints')
            ->search($request->search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:complaint_categories,nama',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        ComplaintCategory::create($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ComplaintCategory $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, ComplaintCategory $category)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:complaint_categories,nama,'.$category->id,
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ComplaintCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
