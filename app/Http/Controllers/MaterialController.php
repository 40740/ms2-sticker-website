<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\View\View;

class MaterialController extends Controller
{
    /**
     * Display the materials landing page listing all material categories.
     */
    public function index(): View
    {
        // Load all material categories with their products
        $categories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('material')
            ->active()
            ->ordered()
            ->get();

        // Get all products in material group for featured display
        $materialProducts = Product::whereHas('category', function ($query) {
            $query->byGroup('material');
        })
            ->active()
            ->ordered()
            ->take(8)
            ->get();

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('materials.index', compact('categories', 'materialProducts', 'brands'));
    }

    /**
     * Display a specific material category page.
     */
    public function show(string $slug): View
    {
        $category = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('material')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Category-level FAQs
        $faqs = Faq::where('category_id', $category->id)
            ->active()
            ->ordered()
            ->get();

        // Related products from same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $category->id)
            ->active()
            ->ordered()
            ->take(8)
            ->get();

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('materials.show', compact('category', 'faqs', 'relatedProducts', 'brands'));
    }
}
