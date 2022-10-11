<?php

namespace App\Exports;

use App\Models\TypesViolations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TypesViolationsExport implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'Pelanggaran',
            'Jumlah',
        ];
    }

    public function collection()
    {
        return TypesViolations::select('id', 'name_violation', 'sum_points')->get();
    }

    public function map($typesV): array
    {
        return [
            $typesV->id,
            $typesV->name_violation,
            $typesV->sum_points,
        ];
    }
}
