<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\View\View;

class IndustryController extends Controller
{
    /**
     * Display the industries landing page listing all industry solutions.
     */
    public function index(): View
    {
        // Load all industry categories with their products
        $categories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('industry')
            ->active()
            ->ordered()
            ->get();

        // Get featured industries
        $featuredIndustries = $categories->take(6);

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('industries.index', compact('categories', 'featuredIndustries', 'brands'));
    }

    /**
     * Display a specific industry solution page.
     */
    public function show(string $slug): View
    {
        $category = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('industry')
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

        return view('industries.show', compact('category', 'faqs', 'relatedProducts', 'brands'));
    }
}
