<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->ordered()->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'type' => 'required|in:sticker,label',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->uploadFile($request->file('hero_image'), 'categories');
        }

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'type' => 'required|in:sticker,label',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->uploadFile($request->file('hero_image'), 'categories');
        }

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Upload a file to public/uploads/{subdir}/ and return the relative path.
     */
    protected function uploadFile($file, string $subdir): string
    {
        $filename = $subdir . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destPath = public_path('uploads/' . $subdir);
        if (!is_dir($destPath)) {
            mkdir($destPath, 0755, true);
        }
        $file->move($destPath, $filename);
        return '/uploads/' . $subdir . '/' . $filename;
    }
}
