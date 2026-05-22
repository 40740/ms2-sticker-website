<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * Display a listing of brands.
     */
    public function index(): View
    {
        $brands = Brand::ordered()->get();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create(): View
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'link' => 'nullable|url|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $request->file('image')->store('brands', 'uploads');
        $validated['is_active'] = $request->has('is_active');

        Brand::create($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand.
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('brands', 'uploads');
        }

        $validated['is_active'] = $request->has('is_active');

        $brand->update($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
