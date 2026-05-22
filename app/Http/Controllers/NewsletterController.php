<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NewsletterController extends Controller
{
    /**
     * Handle a newsletter subscription from the frontend.
     */
    public function subscribe(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Gracefully handle missing subscribers table (before migration is run)
        if (!Schema::hasTable('subscribers')) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription system is being set up. Please try again later.',
            ], 503);
        }

        try {
            // Check if already actively subscribed
            $existing = Subscriber::where('email', $validated['email'])
                ->where('is_active', true)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => true,
                    'message' => 'You are already subscribed! Thank you for your continued interest.',
                ]);
            }

            // Subscribe or re-activate
            Subscriber::subscribe($validated['email'], 'newsletter');

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing! You\'ll receive our latest updates and offers.',
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
