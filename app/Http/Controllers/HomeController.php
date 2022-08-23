<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = [
            'title' => 'Admin Dashboard'
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
