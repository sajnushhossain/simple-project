<?php

namespace App\Exports;

use App\Models\ModeratorAccessLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ModeratorAccessInfoExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModeratorAccessLog::with('user')
            ->where('created_at', '>=', now()->subMonth())
            ->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Moderator Name',
            'Moderator Email',
            'Route Accessed',
            'Time',
        ];
    }

    /**
    * @param ModeratorAccessLog $log
    * @return array
    */
    public function map($log): array
    {
        return [
            $log->user->name,
            $log->user->email,
            $log->route,
            $log->created_at->toDateTimeString(),
        ];
    }
}
