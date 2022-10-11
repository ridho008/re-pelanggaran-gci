<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use App\Exports\PointsExport;
use Maatwebsite\Excel\Facades\Excel;

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

    // ------------------------- ROLE USERS -------------------------------------

    public function indexPoint()
    {   
        $points = Point::where('reporting_point', auth()->user()->id)->with('types')->paginate(6);
        $pointCount = Point::join('types_violations', 'types_violations.id', 'points.typevio_id')->where('reporting_point', auth()->user()->id)->sum('sum_points');

        $data = [
            'points' => $points,
            'pointCount' => $pointCount,
        ];
        return view('user.points.index', $data);
    }

    public function getDetailPoint(int $id)
    {
        $point = Point::where('id', $id)->with('types')->get()[0];
        $proof_fhoto = $point->reports->proof_fhoto;
        $title = $point->reports->title;
        $reporting_date = $point->reports->reporting_date;
        $description = $point->reports->description;
        $reply_comment = $point->reports->reply_comment;
        $pointSum = $point->types->sum_points;
        $name_violation = $point->types->name_violation;

        $data = [
            'point' => $point,
            'proof_fhoto' => $proof_fhoto,
            'title' => $title,
            'reporting_date' => $reporting_date,
            'description' => $description,
            'reply_comment' => $reply_comment,
            'point' => $pointSum,
            'name_violation' => $name_violation,
        ];

        return json_encode($data);
    }

    public function printSP1($id)
    {
        $reportPDF = User::where('id', $id)->with('types')->get();

        $data = [
            'title' => 'PT.Garuda Cyber Indonesia',
            'address' => 'Alamat: Jl. HR. Soebrantas No.188, Sidomulyo Baru, Kec. Tampan, Kota Pekanbaru, Riau 28293',
            'reportPDF' => $reportPDF,
        ];
        
        $pdf = PDF::loadView('user.generate-reporting.sp1', $data);
        return $pdf->download('surat-peringatan-1-GCI.pdf');
    }

    public function printSP2($id)
    {
        $reportPDF = User::where('id', $id)->with('types')->get();

        $data = [
            'title' => 'PT.Garuda Cyber Indonesia',
            'address' => 'Alamat: Jl. HR. Soebrantas No.188, Sidomulyo Baru, Kec. Tampan, Kota Pekanbaru, Riau 28293',
            'reportPDF' => $reportPDF,
        ];
        
        $pdf = PDF::loadView('user.generate-reporting.sp2', $data);
        return $pdf->download('surat-peringatan-2-GCI.pdf');
    }

    public function pdfPoints()
    {
        return Excel::download(new PointsExport(), 'points.pdf');
    }

    public function excelPoints()
    {
        return Excel::download(new PointsExport(), 'points.csv');
    }
}
