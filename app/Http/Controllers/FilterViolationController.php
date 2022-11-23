<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use Yajra\DataTables\Facades\DataTables;

class FilterViolationController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()) {
          if(!empty($request->month)) {
            $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
                    ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                    ->join('users', 'users.id', '=', 'report.user_id')
                    ->where('report.status', 0)
                    ->where('users.role', 0)
                    ->whereMonth('reporting_date', $request->month)
                    ->whereYear('reporting_date', $request->year)
                    // ->whereBetween('reporting_date', [$request->from_date, $request->to_date])
                    ->where('users.is_active', 1) // active account
                    ->orderBy('types_violations.sum_points', 'DESC')
                    ->get();
           // $data = Report::table('tbl_order');
           //   ->whereBetween('order_date', array($request->from_date, $request->to_date))
           //   ->get();
          } else {
            $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
                    ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                    ->join('users', 'users.id', '=', 'report.user_id')
                    ->where('report.status', 0)
                    ->where('users.role', 0)
                    // ->where('users.is_active', 1) // active account
                    ->get();
          }
          return DataTables::of($model)->toJson();
        }
        $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $jlh_bln = count($bulan);
        

        $data = [
            // 'filter' => $filter,
            'jlh_bln' => $jlh_bln,
            'bulan' => $bulan,
        ];
        return view('admin.filter-violation.index', $data);
    }

    public function activeFilterViolation()
    {
        // $data = Report::select('report.*', 'types_violations.*', 'users.*')
        //         ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
        //         ->join('users', 'users.id', '=', 'report.user_id')
        //         ->where('report.status', 0)
        //         ->where('users.role', 0)
        //         ->where('users.is_active', 1) // active account
        //         // ->whereMonth('report.reporting_date', date('m'))
        //         ->get();
        // return json_encode($data);
        $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
                ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                ->join('users', 'users.id', '=', 'report.user_id')
                ->where('report.status', 0)
                ->where('users.role', 0)
                ->where('users.is_active', 1) // active account
                // ->whereMonth('report.reporting_date', date('m'))
                ->get();

        return DataTables::of($model)->toJson();
    }

    public function nonActiveFilterViolation()
    {
        // $data = Report::select('report.*', 'types_violations.*', 'users.*')
        //         ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
        //         ->join('users', 'users.id', '=', 'report.user_id')
        //         ->where('report.status', 0)
        //         ->where('users.role', 0)
        //         ->where('users.is_active', 0) // active account
        //         // ->where('')
        //         ->get();
        // return json_encode($data);

        $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
                ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                ->join('users', 'users.id', '=', 'report.user_id')
                ->where('report.status', 0)
                ->where('users.role', 0)
                ->where('users.is_active', 0) // active account
                // ->whereMonth('report.reporting_date', date('m'))
                ->get();
        return DataTables::of($model)->toJson();
    }

    public function rangeDate($month, $year)
    {
        // $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
        //         ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
        //         ->join('users', 'users.id', '=', 'report.user_id')
        //         ->where('report.status', 0)
        //         ->where('users.role', 0)
        //         ->whereMonth('reporting_date', $month)
        //         ->whereYear('reporting_date', $year)
        //         ->where('users.is_active', 1) // active account
        //         ->get();

        // return DataTables::of($model)->toJson();
    }

}
