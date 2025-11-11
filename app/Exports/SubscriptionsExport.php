<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SubscriptionsExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subscription::all(['email', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'Email',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Subscriptions';
    }
}
