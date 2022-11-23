<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Postimage;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select('id', 'fullname', 'role', 'email', 'is_active')->get();
        $data = [
            'users' => $users,
        ];
        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if($user->email != $request->input('email')) {
            $validateEmail = 'required|unique:users';
        } else {
            $validateEmail = 'required';
        }

        $request->validate([
            'email' => $validateEmail,
            'password' => 'required',
            'fullname' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);

        $user->save();

        $request->session()->flash('success', 'Akun Berhasil Ditambahkan.');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isActive($id)
    {
        User::where('id', $id)->update(['is_active' => 1]);
        return back()->with('success', 'Akun berhasil di aktifkan.');
    }

    public function isNonActive($id)
    {
        User::where('id', $id)->update(['is_active' => 0]);
        return back()->with('success', 'Akun berhasil di nonaktifkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // $string = "asdaswekasd";
        // $func = preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);
        // dd($func);
        $data = [
            'user' => $user,
        ];
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        $user = User::findOrFail($id);
        // dd($user->email);
        if($user->email != $request->input('email')) {
            $validateEmail = 'required|unique:users';
        } else {
            $validateEmail = 'required';
        }

        $request->validate([
            'email' => $validateEmail,
            'password' => 'required',
            'fullname' => 'required',
        ]);

        // dd("berhasil");

        $userUpdate = User::where('id', $id)
            ->update([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'is_active' => $request->input('is_active'),
        ]);

        // $userUpdate->save();

        // $user->update($request->all());

        return redirect('/admin/users')->with('success', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::findOrFail($id);
        if($user->image != 'default.svg') {
            unlink('public/assets/img/' . $user->image);
        }
        User::destroy($id);
        return redirect('/admin/users')->with('success', 'Berhasil menghapus data.');
    }

    // ---- Profile -----
    public function profile()
    {
        $user = User::findOrFail(auth()->user()->id);
        $data = [
            'user' => $user,
        ];
        return view('user.profile.index', $data);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($user->email != $request->input('email')) {
            $validateEmail = 'required|unique:users';
        } else {
            $validateEmail = 'required';
        }

        $request->validate([
            'email' => $validateEmail,
            'fullname' => 'required',
            'old_image' => 'required',
            'image' => 'mimes:jpg,bmp,png'
        ]);

        if($request->file('image') != null){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move('assets/img/', $filename);
            unlink('assets/img/' . $request->input('old_image'));
            // $data['image']= $filename;
            // dd($filename);
        } else {
            $filename = $request->input('old_image');
        }


        $userUpdate = User::where('id', $id)->update([
            'fullname' => $request->input('fullname'),
            'image' => $filename,
        ]);

        return redirect('/profile')->with('success', 'Berhasil memperbarui profil.');
    }

    public function exportUsers(Request $request)
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    public function pdfUsers(Request $request)
    {
        return Excel::download(new UsersExport, 'users.pdf');
    }
}
