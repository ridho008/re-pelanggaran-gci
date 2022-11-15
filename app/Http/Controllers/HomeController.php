<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Point;
use App\Models\Report;
use App\Models\TypesViolations;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // Graph
        // $totalPoint = User::select(DB::raw('SUM(amount_total) as paidsum');
        // $userGraph = Point::select('*')
        //             ->join('users', 'users.id', '=', 'points.reporting_point')
        //             ->join('types_violations', 'types_violations.id', '=', 'points.typevio_id')
        //             ->whereMonth('points.created_at', date('m'))
        //             ->pluck('types_violations.sum_points', 'users.fullname');
            
        // $labels = $userGraph->keys();

        // $dataGraph = $userGraph->values(); // jml pelanggaran
        // dd($userGraph);

        $graph = Report::select('users.*', 'report.*', 'types_violations.*', DB::raw('SUM(types_violations.sum_points) as typesSum'))
            ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
            ->join('users', 'users.id', '=', 'report.user_id')
            ->where('report.status', 0)
            ->where('users.is_active', 1)
            ->where('users.role', 0)
            ->whereMonth('report.reporting_date', 10)
            ->groupBy('report.user_id')
            ->orderBy('types_violations.sum_points', 'DESC')
            ->skip(0)->take(5)
            ->pluck('typesSum', 'users.fullname');

        $labels = $graph->keys();
        $dataGraph = $graph->values();
        // dd($labels, $dataGraph);
        // SELECT user_id, sum(point) jml_point FROM `report` 
        // where reporting_date BETWEEN '2022-10-01' and '2022-10-30'
        // and status = 0 
        // group by user_id

        $employeePoint = Report::select('types_violations.sum_points', 'users.is_active','types_violations.sum_points', 'report.user_id', 'users.fullname', DB::raw('SUM(types_violations.sum_points) as typesSum'))
                        ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                        ->join('users', 'users.id', '=', 'report.user_id')
                        ->where('report.status', 0)
                        ->where('users.role', 0)
                        ->where('users.is_active', 1)
                        ->whereMonth('report.reporting_date', 10)
                        ->groupBy('report.user_id')
                        ->orderBy('types_violations.sum_points', 'DESC')
                        ->skip(0)->take(5)
                        ->get();
        // dd($employeePoint);

        $data = [
            'title' => 'Admin Dashboard',
            'labels' => $labels,
            'data' => $dataGraph,
            'employeePoint' => $employeePoint,
        ];
        return view('admin.index', $data);
    }

    public function userDashboard()
    {
        $data = [
            'title' => 'User Dashboard'
        ];
        return view('user.index', $data);
    }

    public function dateIndonesia($tanggal)
    {
        $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
         
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}
