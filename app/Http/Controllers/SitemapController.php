<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate a dynamic sitemap.xml for SEO.
     */
    public function index(): Response
    {
        $products = Product::active()->orderBy('updated_at', 'desc')->get();
        $posts = BlogPost::published()->latestPublished()->get();
        $categories = Category::active()->orderBy('sort_order')->get();

        return response()
            ->view('sitemap', compact('products', 'posts', 'categories'))
            ->header('Content-Type', 'text/xml');
    }
}
