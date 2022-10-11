<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Point;

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
        $userGraph = Point::select('*')
                    ->join('users', 'users.id', '=', 'points.reporting_point')
                    ->join('types_violations', 'types_violations.id', '=', 'points.typevio_id')
                    ->whereMonth('points.created_at', date('m'))
                    ->pluck('types_violations.sum_points', 'users.fullname');
            
        $labels = $userGraph->keys();

        $dataGraph = $userGraph->values(); // jml pelanggaran
        // dd($userGraph);

        $data = [
            'title' => 'Admin Dashboard',
            'labels' => $labels,
            'data' => $dataGraph,
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
}
