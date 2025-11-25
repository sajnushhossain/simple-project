<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PostsExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Post::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->get(['title', 'slug', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'Title',
            'Slug',
            'Created At',
        ];
    }

    public function title(): string
    {
        return 'Monthly Posts';
    }
}
