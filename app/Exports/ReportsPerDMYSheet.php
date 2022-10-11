<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Carbon\Carbon;

class ReportsPerDMYSheet implements FromCollection, WithHeadings, WithMapping
{
    // use Exportable;

    // protected $from_date;
    // protected $to_date;

    // public function __construct($from_date, $to_date)
    // {
    //     $this->from_date = $from_date;
    //     $this->to_date  = $to_date;
    // }

    

    // public function query()
    // {
    //     return Report::query()
    //         ->whereBetween('created_at',[ $this->from_date,$this->to_date])
    //         ->with('user');
    // }

    public function collection()
    {
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');
        // dd($to_date);
        return Report::with('user')->whereBetween('created_at', [$from_date, $to_date])->get();
    }

    public function map($report): array
    {
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

    // public function view(): View
    // {
    //     return view('admin.reports.exports.reports', [
    //         'reports' => Report::with('user')->whereBetween('created_at',[ $this->from_date,$this->to_date])->get(),
    //     ]);
    // }
}
