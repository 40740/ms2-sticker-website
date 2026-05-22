<?php

namespace App\Exports;

use App\Models\Subscriber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubscriberExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Subscriber::orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'Source',
            'Status',
            'Subscribed At',
            'Unsubscribed At',
            'Created At',
        ];
    }

    /**
     * @param Subscriber $subscriber
     * @return array
     */
    public function map($subscriber): array
    {
        return [
            $subscriber->id,
            $subscriber->email,
            $subscriber->source,
            $subscriber->is_active ? 'Active' : 'Unsubscribed',
            $subscriber->subscribed_at?->format('Y-m-d H:i:s'),
            $subscriber->unsubscribed_at?->format('Y-m-d H:i:s'),
            $subscriber->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
