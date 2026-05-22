<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Category;
use App\Models\BlogPost;
use App\Models\Subscriber;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with inquiry count stats.
     */
    public function index(): View
    {
        $totalInquiries = Inquiry::count();
        $unreadInquiries = Inquiry::unread()->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBlogPosts = BlogPost::count();

        // Gracefully handle missing subscribers table
        try {
            $totalSubscribers = Subscriber::active()->count();
        } catch (\Throwable $e) {
            $totalSubscribers = 0;
        }

        $recentInquiries = Inquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalInquiries',
            'unreadInquiries',
            'totalProducts',
            'totalCategories',
            'totalBlogPosts',
            'totalSubscribers',
            'recentInquiries'
        ));
    }
}
