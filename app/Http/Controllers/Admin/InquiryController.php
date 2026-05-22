<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InquiryExport;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries with filters.
     */
    public function index(): View
    {
        $filter = request('filter', 'all');

        $query = Inquiry::latest();

        if ($filter === 'unread') {
            $query->unread();
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $inquiries = $query->paginate(20);

        return view('admin.inquiries.index', compact('inquiries', 'filter'));
    }

    /**
     * Mark as read and show the specified inquiry.
     */
    public function show(Inquiry $inquiry): View
    {
        if (!$inquiry->is_read) {
            $inquiry->markAsRead();
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Export inquiries to Excel.
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new InquiryExport, 'inquiries-' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Remove the specified inquiry.
     */
    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
