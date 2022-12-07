<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Report;
use App\Models\User;
use App\Models\TypesViolations;
use DB;


class FilterReportController extends Controller
{
    public function index(Request $request)
    {
        // $model = TypesViolations::select(DB::raw('sum_points' ,'SUM(IF sum_points >= 20) as typesSum'))
        // ->get();

        // $model = Report::select('report.*', 'types_violations.id', 'types_violations.sum_points' , 'users.*', DB::raw('SUM(IF types_violations.sum_points >= 20) as typesSum'))
        //           ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
        //           ->join('users', 'users.id', '=', 'report.user_id')
        //           ->where('report.status', 0)
        //           ->where('users.role', 0)
        //           // ->where('types_violations.sum_points', 20, '>=')
        //           ->where('users.is_active', 1) // active account
        //           // ->process()
        //           ->groupBy('report.user_id')
        //           ->get();
        // $model = DB::select(DB::raw("SELECT types_violations.sum_points, types_violations.id, report.*, users.* FROM report INNER JOIN type "));

        // Example Mysql
        // SELECT SUM(types_violations.sum_points) AS total, types_violations.*, users.* FROM report
        // INNER JOIN users ON users.id = report.user_id
        // INNER JOIN types_violations ON types_violations.id = report.types_id
        // WHERE report.status = 0 AND
        // users.role = 0 AND
        // users.is_active = 1 AND
        // total < 15
        // GROUP BY report.user_id
        // SELECT types_violations.id, users.*, SUM(types_violations.sum_points) AS total FROM report INNER JOIN users ON users.id = report.user_id INNER JOIN types_violations ON types_violations.id = report.types_id WHERE report.status = 0 AND users.role = 0 AND users.is_active = 1 GROUP BY report.user_id HAVING total >= 20 
        // dd($model);
        if(request()->ajax()) {
          $model = Report::query()->select('reports.*', 'types_violations.*', 'users.*', DB::raw('SUM(types_violations.sum_points) as total'))
                  ->join('types_violations', 'types_violations.id', '=', 'reports.types_id')
                  ->join('users', 'users.id', '=', 'reports.user_id')
                  ->where('reports.status', 0)
                  ->where('users.role', 0)
                  ->where('users.menu_report_status', 0)
                  // ->where('types_violations.sum_points', 20, '>=')
                  ->where('users.is_active', 1) // active account
                  // ->process()
                  ->groupBy('reports.user_id')
                  ->having('total', '>=', 20)
                  ->get();
          return DataTables::of($model)->toJson();
        }
        
        

        $data = [
        ];
        return view('admin.filter-reports.index', $data);
    }

    public function activeReportFil($id)
    {
            User::where('id', $id)
                ->update([
                'menu_report_status' => 1,
            ]);
            
            return redirect()->route('filter.report.admin')->with('success', 'Berhasil nonaktifkan akun.');

    }
}
