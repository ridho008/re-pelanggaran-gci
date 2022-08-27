<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $reports = Report::select('id', 'user_id', 'proof_fhoto', 'reporting_date', 'status')->get();
        $reports = User::join('report', 'users.id', '=', 'report.user_id')
                ->get(['users.*', 'report.*']);
        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::select('id', 'fullname', 'role')
                // ->get();
        // $reports = Report::select('user_id')->get();
        // dd($reports);

        // $reports = User::join('report', 'users.id', '=', 'report.user_id')
        //         ->get(['users.*', 'report.*']);

        $reports = DB::table('report')
            ->rightJoin('users', 'users.id', '=', 'report.user_id')
            ->select('users.id as tb_user_id', 'report.user_id as tb_report_user_id', 'users.fullname', 'users.id as tb_users_id')
            ->get();
        // dd($reports);
        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            'reporting_date' => 'required',
            'proof_fhoto' => 'mimes:jpg,bmp,png',
            'status' => 'required',
        ]);

        if($request->file('proof_fhoto') != null){
            $file= $request->file('proof_fhoto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move('assets/img/pelaporan/', $filename);
        }

        $user = Report::create([
            'user_id' => $request->input('user_id'),
            'description' => $request->input('description'),
            'proof_fhoto' => $filename,
            'reporting_date' => $request->input('reporting_date'),
            'status' => $request->input('status'),
        ]);

        $user->save();

        $request->session()->flash('success', 'Akun Berhasil Ditambahkan.');
        return redirect()->route('reports.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report, User $user, $id)
    {
        // $id = id table report
        // $resultUser = $user->select('id', 'fullname')->get();
        $resultUser = DB::table('report')
            ->rightJoin('users', 'users.id', '=', 'report.user_id')
            ->select('users.id as tb_user_id', 'report.user_id as tb_report_user_id', 'users.fullname', 'users.id as tb_users_id')
            ->get();
        $row = Report::findOrFail($id);
        // dd($row->user_id);
        $data = [
            'report' => $row,
            'users' => $resultUser,
        ];
        return view('admin.reports.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            'reporting_date' => 'required',
            'proof_fhoto' => 'mimes:jpg,bmp,png',
            'status' => 'required',
        ]);

        if($request->file('proof_fhoto') != null){
            $file= $request->file('proof_fhoto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move('assets/img/pelaporan/', $filename);
            unlink('assets/img/pelaporan/' . $request->input('old_proof_fhoto'));
        } else {
            $filename = $request->input('old_proof_fhoto');
        }

        Report::where('id', $id)
            ->update([
            'user_id' => $request->input('user_id'),
            'description' => $request->input('description'),
            'proof_fhoto' => $filename,
            'reporting_date' => $request->input('reporting_date'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('reports.admin')->with('success', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report, $id)
    {
        $reportRow = $report->findOrFail($id);
        // dd($reportRow->proof_fhoto);
        if($reportRow->proof_fhoto != null) {
            unlink('assets/img/pelaporan/' . $reportRow->proof_fhoto);
        }
        Report::destroy($id);
        return redirect()->route('reports.admin')->with('success', 'Berhasil menghapus data.');
    }

    public function detail($id)
    {
        // $report = User::join('report', 'users.id', '=', 'report.user_id')
        //         ->where('report.user_id', '=', 'users.id')
        //         ->get();

        // $report = DB::table('users')
        //         ->join('report', function($join) use ($id) {
        //             $join->on('users.id', '=', 'report.user_id')
        //                 ->where('users.id', '=', $id);
        //         })->get();

        // $report = DB::table('report')
        // ->join('users', 'id', '=', 'report.user_id')
        // ->where('users.id', '=', "report.$id")
        // ->select('report.*')
        // ->get();

        // $report = Report::find($id)->users();

        $report = User::join('report', 'report.user_id', '=', 'users.id')
            ->where('report.id', $id)->first();
        // dd($report);
        $data = [
            'report' => $report,
        ];
        return view('admin.reports.detail', $data);
    }

    public function replyComment(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        Report::where('id', $id)->update([
            'reply' => $request->input('reply')
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function verified()
    {
        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.verified', $data);
    }
}
