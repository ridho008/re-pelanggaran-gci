<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $reports = Report::with('users')->paginate(5);

        $request->validate([
            'proof_fhoto' => 'mimes:jpg,bmp,png',
        ]);
        
        $data = [
            'request' => $request,
            'reports' => $reports,
        ];
        return view('admin.reports.index', $data);
    }

    public function pageAgree()
    {
        $reports = Report::with('users')->where('status', '=', 0)->paginate(5);

        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.agree', $data);
    }

    public function pageReject()
    {
        $reports = Report::with('users')->where('status', '=', 1)->paginate(5);

        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.reject', $data);
    }

    public function pageVerification()
    {
        $reports = Report::with('users')->where('status', '=', 2)->paginate(5);

        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.verification', $data);
    }

    public function create()
    {
        $reports = DB::table('report')
            ->rightJoin('users', 'users.id', '=', 'report.user_id')
            ->select('users.id as tb_user_id', 'report.user_id as tb_report_user_id', 'users.fullname', 'users.id as tb_users_id', 'users.role')
            ->get();
            // dd($reports);
        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
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
            'reporting' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'proof_fhoto' => $filename,
            'reporting_date' => $request->input('reporting_date'),
            'status' => $request->input('status'),
        ]);

        $user->save();

        $request->session()->flash('success', 'Akun Berhasil Ditambahkan.');
        return redirect()->route('reports.admin');
    }

    public function edit(Report $report, User $user, $id)
    {
        $resultUser = DB::table('report')
            ->rightJoin('users', 'users.id', '=', 'report.user_id')
            ->select('users.id as tb_user_id', 'report.user_id as tb_report_user_id', 'users.fullname', 'users.id as tb_users_id')
            ->get();
        $row = Report::findOrFail($id);

        $data = [
            'report' => $row,
            'users' => $resultUser,
        ];
        return view('admin.reports.edit', $data);
    }

    public function update(Request $request, Report $report, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
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
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'proof_fhoto' => $filename,
            'reporting_date' => $request->input('reporting_date'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('reports.admin')->with('success', 'Berhasil mengubah data.');
    }

    public function destroy(Report $report, $id)
    {
        $reportRow = $report->findOrFail($id);

        if($reportRow->proof_fhoto != null) {
            unlink('assets/img/pelaporan/' . $reportRow->proof_fhoto);
        }
        Report::destroy($id);
        return redirect()->route('reports.admin')->with('success', 'Berhasil menghapus data.');
    }

    public function detail($id)
    {
        $users = Report::with('users')->where('id', '=', $id)->get();
        $data = [
            'report' => $users,
        ];
        return view('admin.reports.detail', $data);
    }

    public function replyComment(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        Report::where('id', $id)->update([
            'reply_comment' => $request->input('reply')
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function verified()
    {
        $reports = Report::with('users')->paginate(5);

        $data = [
            'reports' => $reports,
        ];
        return view('admin.reports.verified', $data);
    }

    // Page Verification
    public function status(Request $request, $id)
    {

        $request->validate([
            'status' => 'required',
        ]);

        Report::where('id', $id)
            ->update([
                'status' => $request->input('status'),
                'updated_at' => Carbon::now(),
            ]);

        $request->session()->flash('success', 'Status berhasil diperbarui.');
        return back();
    }

    // ------------ Users ----------------
    public function indexReportUser(Request $request)
    {
        $id = auth()->user()->id;
        $reports = Report::with('users')->where('reporting', '=', $id)->paginate(5);
        // dd($reports);
        
        $data = [
            'reports' => $reports,
        ];
        return view('user.reports.index', $data);
    }

    public function detailStatus(Request $request, $id)
    {
        Report::where('id', $id)
            ->update([
                'status' => 0,
                'updated_at' => Carbon::now(),
            ]);

        $request->session()->flash('success', 'Status berhasil diperbarui.');
        return back();
    }

    public function createReport(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'reporting_date' => 'required',
            'proof_fhoto' => 'mimes:jpg,bmp,png',
        ]);

        if($request->file('proof_fhoto') != null){
            $file= $request->file('proof_fhoto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move('assets/img/pelaporan/users/', $filename);
        }

        $user = Report::create([
            'reporting' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'proof_fhoto' => $filename,
            'reporting_date' => $request->input('reporting_date'),
            'status' => 0,
        ]);

        $user->save();

        return back()->with('success', 'Laporan Berhasil Ditambahkan.');
    }
}
