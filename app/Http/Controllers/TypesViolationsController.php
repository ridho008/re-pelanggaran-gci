<?php

namespace App\Http\Controllers;

use App\Models\TypesViolations;
use Illuminate\Http\Request;

class TypesViolationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $typesV = TypesViolations::paginate(6);
        $data = [
            'typesV' => $typesV,
        ];
        return view('admin.types-violations.index', $data);
    }

    public function getTypesVByID($id)
    {
        $data = TypesViolations::where('id', $id)->get()[0];
        return json_encode($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_violation' => 'required',
            'sum_points' => 'required',
        ]);

        $typesV = TypesViolations::create([
            'name_violation' => $request->input('name_violation'),
            'sum_points' => $request->input('sum_points'),
        ]);

        $typesV->save();

        $request->session()->flash('success', 'Jenis Pelanggaran Berhasil Ditambahkan.');
        return redirect()->route('typesVio.admin');
    }

    public function update(Request $request, TypesViolations $typesViolations)
    {
        $request->validate([
            'name_violation' => 'required',
            'sum_points' => 'required',
        ]);

        $id = $request->input('id');

        TypesViolations::where('id', $id)->update([
            'id' => $id,
            'name_violation' => $request->input('name_violation'),
            'sum_points' => $request->input('sum_points'),
        ]);

        $request->session()->flash('success', 'Berhasil Diperbarui.');
        return redirect()->route('typesVio.admin');
    }

    public function destroy($id)
    {
        TypesViolations::destroy($id);
        return redirect()->route('typesVio.admin')->with('success', 'Berhasil menghapus data.');
    }
}
