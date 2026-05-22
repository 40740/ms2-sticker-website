<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Handle an AJAX inquiry form submission.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50|regex:/^[0-9+\-\(\)\s]+$/',
            'message' => 'nullable|string|max:5000',
            'design' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,ai,psd,eps,cdr',
            'page_source' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        if ($request->hasFile('design')) {
            $filePath = $request->file('design')->store('inquiries', 'uploads');
            $validated['file_path'] = $filePath;
        }

        unset($validated['design']);

        // Create the inquiry
        $inquiry = Inquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your inquiry! We will get back to you soon.',
        ], 201);
    }
}
