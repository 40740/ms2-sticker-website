<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates.
     */
    public function index(): View
    {
        $certificates = Certificate::ordered()->get();

        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new certificate.
     */
    public function create(): View
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created certificate.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $request->file('image')->store('certificates', 'uploads');
        $validated['is_active'] = $request->has('is_active');

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate created successfully.');
    }

    /**
     * Show the form for editing the specified certificate.
     */
    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified certificate.
     */
    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('certificates', 'uploads');
        }

        $validated['is_active'] = $request->has('is_active');

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully.');
    }

    /**
     * Remove the specified certificate.
     */
    public function destroy(Certificate $certificate): RedirectResponse
    {
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate deleted successfully.');
    }
}
