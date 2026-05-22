<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubscriberExport;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SubscriberController extends Controller
{
    /**
     * Display a listing of subscribers with filters.
     */
    public function index(): View
    {
        // Gracefully handle missing subscribers table (before migration is run)
        if (!Schema::hasTable('subscribers')) {
            $subscribers = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $filter = 'all';
            $totalActive = 0;
            $totalInactive = 0;
            $totalAll = 0;

            return view('admin.subscribers.index', compact(
                'subscribers', 'filter', 'totalActive', 'totalInactive', 'totalAll'
            ));
        }

        $filter = request('filter', 'all');

        $query = Subscriber::latest();

        if ($filter === 'active') {
            $query->active();
        } elseif ($filter === 'inactive') {
            $query->inactive();
        }

        $subscribers = $query->paginate(20);
        $totalActive = Subscriber::active()->count();
        $totalInactive = Subscriber::inactive()->count();
        $totalAll = Subscriber::count();

        return view('admin.subscribers.index', compact(
            'subscribers', 'filter', 'totalActive', 'totalInactive', 'totalAll'
        ));
    }

    /**
     * Remove the specified subscriber.
     */
    public function destroy(Subscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('success', '订阅者已删除。');
    }

    /**
     * Export subscribers to Excel.
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new SubscriberExport, 'subscribers-' . now()->format('Y-m-d') . '.xlsx');
    }
}
