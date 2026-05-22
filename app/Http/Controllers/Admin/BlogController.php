<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(): View
    {
        $posts = BlogPost::latest()->paginate(20);

        return view('admin.blog-posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create(): View
    {
        return view('admin.blog-posts.create');
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'uploads');
        }

        $validated['is_published'] = $request->has('is_published');

        // If published but no published_at set, use now
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'uploads');
        }

        $validated['is_published'] = $request->has('is_published');

        // If published but no published_at set, use now
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
