<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ContactsExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->get(['name', 'email', 'subject', 'message', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Subject',
            'Message',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Contacts';
    }
}
