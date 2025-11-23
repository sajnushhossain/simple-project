<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WebsiteDataExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new SummaryExport,
            new PostsExport,
            new SubscriptionsExport,
            new ContactsExport,
        ];
    }
}
