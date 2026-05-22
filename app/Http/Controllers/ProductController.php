<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product catalog by type (sticker or label).
     */
    public function catalog(string $type): View
    {
        // Validate type
        if (!in_array($type, ['sticker', 'label'])) {
            abort(404);
        }

        // Load categories of this type with their active products
        $categories = Category::with(['products' => function ($query) {
            $query->active()->ordered();
        }])
            ->where('type', $type)
            ->active()
            ->ordered()
            ->get();

        // Category-level FAQs
        $categoryIds = $categories->pluck('id');
        $faqs = Faq::with('category')
            ->whereIn('category_id', $categoryIds)
            ->active()
            ->ordered()
            ->get();

        // Brands
        $brands = Brand::active()->ordered()->get();

        $typeLabel = ucfirst($type);

        return view('products.catalog', compact('categories', 'faqs', 'brands', 'type', 'typeLabel'));
    }

    /**
     * Display a single product detail page.
     */
    public function show(string $slug): View
    {
        $product = Product::with(['category', 'faqs' => function ($query) {
            $query->active()->ordered();
        }])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Related products (same category, excluding current)
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->ordered()
            ->take(4)
            ->get();

        // If not enough related products from same category, get from same type
        if ($relatedProducts->count() < 4) {
            $additionalProducts = Product::with('category')
                ->where('type', $product->type)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->active()
                ->ordered()
                ->take(4 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->concat($additionalProducts);
        }

        // Brands
        $brands = Brand::active()->ordered()->get();

        return view('products.show', compact('product', 'relatedProducts', 'brands'));
    }
}
