<?php

namespace App\Exports;

use App\Models\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InquiryExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Inquiry::orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Message',
            'File Path',
            'Page Source',
            'Is Read',
            'Created At',
        ];
    }

    /**
     * @param Inquiry $inquiry
     * @return array
     */
    public function map($inquiry): array
    {
        return [
            $inquiry->id,
            $inquiry->name,
            $inquiry->email,
            $inquiry->phone,
            $inquiry->message,
            $inquiry->file_path,
            $inquiry->page_source,
            $inquiry->is_read ? 'Yes' : 'No',
            $inquiry->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
