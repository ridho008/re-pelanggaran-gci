<?php

namespace App\Exports;

use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportsExport implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'Pelaku',
            'Pelapor',
            'Judul',
            'Jenis Pelanggaran',
            'Deskripsi',
            'Balasan',
            'Tanggal Pelapor',
        ];
    }

    public function collection()
    {
        return Report::with('user')->get();
    }

    public function map($report): array
    {
        $no = 1;
        return [
            $report->id,
            $report->user->fullname,
            $report->report->fullname,
            $report->title,
            $report->typesViolations->name_violation,
            strip_tags($report->description),
            $report->reply_comment ?? "kosong",
            Carbon::parse($report->reporting_date)->toFormattedDateString(),
        ];
    }
}
