<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Display search results for products and blog posts.
     */
    public function index(Request $request): View
    {
        $query = trim($request->input('q', ''));
        $products = collect();
        $posts = collect();

        if ($query) {
            $products = Product::with('category')
                ->active()
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })
                ->orderBy('sort_order')
                ->get();

            $posts = BlogPost::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('excerpt', 'LIKE', "%{$query}%");
                })
                ->latestPublished()
                ->get();
        }

        return view('pages.search', compact('query', 'products', 'posts'));
    }
}
