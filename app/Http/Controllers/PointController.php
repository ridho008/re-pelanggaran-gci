<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $points = Point::with('reports')->paginate(6);
        // dd($points);
        $data = [
            'points' => $points,
        ];
        return view('admin.points.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function detail(Point $point, $id)
    {
        // $row = $point->findOrFail($id);
        // $point = Point::with('reports')->paginate(6);
        // $point = Point::with(['reports' => function($query) use ($id) {
        //     $query->where('points.id', $id);
        // }])

        $point = Point::where('id', '=', $id)->with('reports')->get();
        // dd($point);
        $data = [
            'title' => 'Rincian Data Pelanggaran',
            'point' => $point
        ];
        return view('admin.points.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point, $id)
    {
        $point->destroy($id);
        return redirect()->route('points.admin')->with('success', 'Berhasil menghapus data.');
    }
}
