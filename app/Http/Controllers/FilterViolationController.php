<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;

class FilterViolationController extends Controller
{
    public function index()
    {
        $filter = User::with('reports')
                ->paginate(6);

        $data = [
            'filter' => $filter,
        ];

        return view('admin.filter-violation.index', $data);
    }

    public function activeFilterViolation()
    {
        $data = Report::select('report.*', 'types_violations.*', 'users.*')
                ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                ->join('users', 'users.id', '=', 'report.user_id')
                ->where('report.status', 0)
                ->where('users.role', 0)
                ->where('users.is_active', 1) // active account
                // ->whereMonth('report.reporting_date', date('m'))
                ->get();
        return json_encode($data);
    }

    public function nonActiveFilterViolation()
    {
        $data = Report::select('report.*', 'types_violations.*', 'users.*')
                ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                ->join('users', 'users.id', '=', 'report.user_id')
                ->where('report.status', 0)
                ->where('users.role', 0)
                ->where('users.is_active', 0) // active account
                // ->where('')
                ->get();
        return json_encode($data);
    }

    public function rangeDate()
    {
        return 'Ok';
    }

}
