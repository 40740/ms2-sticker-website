<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ShapeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [PageController::class, 'index'])->name('home');

// About Us
Route::get('/pages/MeisaiPrinting', [PageController::class, 'about'])->name('about');

// Material categories (NEW)
Route::get('/materials', [MaterialController::class, 'index'])->name('materials');
Route::get('/materials/{slug}', [MaterialController::class, 'show'])->name('materials.show');

// Industry solutions (NEW)
Route::get('/industries', [IndustryController::class, 'index'])->name('industries');
Route::get('/industries/{slug}', [IndustryController::class, 'show'])->name('industries.show');

// Shape categories (NEW)
Route::get('/shapes', [ShapeController::class, 'index'])->name('shapes');
Route::get('/shapes/{slug}', [ShapeController::class, 'show'])->name('shapes.show');

// Product catalogs
Route::get('/pages/custom-stickers', [ProductController::class, 'catalog'])->defaults('type', 'sticker')->name('stickers');
Route::get('/pages/custom-labels', [ProductController::class, 'catalog'])->defaults('type', 'label')->name('labels');
Route::get('/pages/blank-labels', [PageController::class, 'blankLabels'])->name('blank-labels');

// Static pages (NEW)
Route::get('/pages/{slug}', [PageController::class, 'page'])->name('pages.show');

// Product detail
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Inquiry form submission (rate limited: 3 per minute)
Route::post('/inquiry', [InquiryController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('inquiry.store');

// Newsletter subscription (rate limited: 5 per minute)
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->middleware('throttle:5,1')
    ->name('newsletter.subscribe');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Login (accessible without auth)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Login rate limited: 5 attempts per minute
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (protected by AdminAuth middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // Products CRUD
    Route::resource('products', AdminProductController::class);

    // FAQs CRUD
    Route::resource('faqs', FaqController::class);

    // Inquiries
    Route::get('/inquiries/export', [AdminInquiryController::class, 'export'])->name('inquiries.export');
    Route::resource('inquiries', AdminInquiryController::class)->except(['create', 'store', 'edit', 'update']);

    // Subscribers
    Route::get('/subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
    Route::resource('subscribers', SubscriberController::class)->except(['create', 'store', 'edit', 'update']);

    // Blog Posts CRUD
    Route::resource('blog-posts', AdminBlogController::class);

    // Certificates CRUD
    Route::resource('certificates', CertificateController::class);

    // Brands CRUD
    Route::resource('brands', BrandController::class);

    // Team Members CRUD
    Route::resource('team-members', TeamMemberController::class);
});
