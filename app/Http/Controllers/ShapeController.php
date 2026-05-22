<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\View\View;

class ShapeController extends Controller
{
    /**
     * Display the shapes landing page listing all shape categories.
     */
    public function index(): View
    {
        // Load all shape categories with their products
        $categories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('shape')
            ->active()
            ->ordered()
            ->get();

        // Load sticker shapes and label shapes separately
        $stickerShapes = $categories->where('type', 'sticker');
        $labelShapes = $categories->where('type', 'label');

        // Get featured shapes
        $featuredShapes = $categories->take(6);

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('shapes.index', compact('categories', 'stickerShapes', 'labelShapes', 'featuredShapes', 'brands'));
    }

    /**
     * Display a specific shape category page.
     */
    public function show(string $slug): View
    {
        $category = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->byGroup('shape')
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

        return view('shapes.show', compact('category', 'faqs', 'relatedProducts', 'brands'));
    }
}
