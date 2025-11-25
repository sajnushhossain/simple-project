<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SummaryExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $postsCount = Post::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $categoriesCount = Category::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $contactsCount = Contact::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $subscriptionsCount = Subscription::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        return collect([
            [
                'Total Posts' => $postsCount,
                'Total Categories' => $categoriesCount,
                'Total Messages' => $contactsCount,
                'Total Subscribers' => $subscriptionsCount,
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Total Posts',
            'Total Categories',
            'Total Messages',
            'Total Subscribers',
        ];
    }

    public function title(): string
    {
        return 'Summary';
    }
}
