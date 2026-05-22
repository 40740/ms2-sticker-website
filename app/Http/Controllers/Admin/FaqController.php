<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(): View
    {
        $faqs = Faq::with(['product', 'category'])->ordered()->paginate(20);

        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create(): View
    {
        $categories = Category::active()->ordered()->get();
        $products = Product::active()->ordered()->get();

        return view('admin.faqs.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created FAQ.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'question' => 'required|string|max:1000',
            'answer' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq): View
    {
        $categories = Category::active()->ordered()->get();
        $products = Product::active()->ordered()->get();

        return view('admin.faqs.edit', compact('faq', 'categories', 'products'));
    }

    /**
     * Update the specified FAQ.
     */
    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'question' => 'required|string|max:1000',
            'answer' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified FAQ.
     */
    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}
