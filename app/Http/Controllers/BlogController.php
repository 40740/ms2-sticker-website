<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display the blog listing with pagination.
     */
    public function index(): View
    {
        $posts = BlogPost::published()
            ->latestPublished()
            ->paginate(9);

        return view('blog.index', compact('posts'))
            ->with('seoTitle', 'Blog – ' . \App\Models\Setting::get('site_name', 'MeisaiPrinting'))
            ->with('seoDescription', 'Latest news, tips, and insights about custom stickers, labels, and printing from MeisaiPrinting.');
    }

    /**
     * Display a single blog post.
     */
    public function show(string $slug): View
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get recent posts for sidebar (excluding current)
        $recentPosts = BlogPost::published()
            ->latestPublished()
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        $seoTitle = $post->title . ' – ' . \App\Models\Setting::get('site_name', 'MeisaiPrinting') . ' Blog';
        $seoDescription = Str::limit(strip_tags($post->content), 160);

        return view('blog.show', compact('post', 'recentPosts'))
            ->with('seoTitle', $seoTitle)
            ->with('seoDescription', $seoDescription);
    }
}
