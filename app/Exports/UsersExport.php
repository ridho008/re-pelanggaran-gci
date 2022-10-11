<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function headings(): array
        {
            return [
                '#',
                'Fullname',
                'Email',
                'Role',
                'created_at',
                'updated_at',
            ];
        }
        // return (new InvoicesExport)->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

    public function collection()
    {
        return User::select('id', 'fullname', 'email', 'role', 'created_at', 'updated_at')->get();
    }
}
