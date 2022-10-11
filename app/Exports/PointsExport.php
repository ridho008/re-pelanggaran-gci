<?php

namespace App\Exports;

use App\Models\Point;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PointsExport implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'Pelaku',
            'Pelapor',
            'Jenis Pelanggaran',
            'Jumlah',
        ];
    }

    public function collection()
    {
        return Point::with('types')->get();
    }

    public function map($point): array
    {
        return [
            $point->id,
            $point->user->fullname,
            $point->reporting->fullname,
            $point->types->name_violation,
            $point->types->sum_points,
        ];
    }
}
