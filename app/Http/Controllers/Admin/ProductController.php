<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::with('category')->ordered()->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'type' => 'required|in:sticker,label',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'features' => 'nullable|array',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
            'features.*.image' => 'nullable|string',
            'steps_title' => 'nullable|string|max:255',
            'steps' => 'nullable|array',
            'steps.*.step' => 'nullable|integer',
            'steps.*.title' => 'nullable|string|max:255',
            'steps.*.description' => 'nullable|string',
            'concerns' => 'nullable|array',
            'concerns.*.title' => 'nullable|string|max:255',
            'concerns.*.description' => 'nullable|string',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.country' => 'nullable|string|max:255',
            'testimonials.*.avatar' => 'nullable|string',
            'testimonials.*.text' => 'nullable|string',
            'is_active' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadFile($request->file('image'), 'products');
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->uploadFile($request->file('hero_image'), 'products');
        }

        $validated['is_active'] = $request->has('is_active');

        // Ensure JSON fields are properly encoded
        $validated['features'] = !empty($validated['features']) ? $validated['features'] : null;
        $validated['steps'] = !empty($validated['steps']) ? $validated['steps'] : null;
        $validated['concerns'] = !empty($validated['concerns']) ? $validated['concerns'] : null;
        $validated['testimonials'] = !empty($validated['testimonials']) ? $validated['testimonials'] : null;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'type' => 'required|in:sticker,label',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'features' => 'nullable|array',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
            'features.*.image' => 'nullable|string',
            'steps_title' => 'nullable|string|max:255',
            'steps' => 'nullable|array',
            'steps.*.step' => 'nullable|integer',
            'steps.*.title' => 'nullable|string|max:255',
            'steps.*.description' => 'nullable|string',
            'concerns' => 'nullable|array',
            'concerns.*.title' => 'nullable|string|max:255',
            'concerns.*.description' => 'nullable|string',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.country' => 'nullable|string|max:255',
            'testimonials.*.avatar' => 'nullable|string',
            'testimonials.*.text' => 'nullable|string',
            'is_active' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadFile($request->file('image'), 'products');
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->uploadFile($request->file('hero_image'), 'products');
        }

        $validated['is_active'] = $request->has('is_active');

        // Ensure JSON fields are properly encoded
        $validated['features'] = !empty($validated['features']) ? $validated['features'] : null;
        $validated['steps'] = !empty($validated['steps']) ? $validated['steps'] : null;
        $validated['concerns'] = !empty($validated['concerns']) ? $validated['concerns'] : null;
        $validated['testimonials'] = !empty($validated['testimonials']) ? $validated['testimonials'] : null;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
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
