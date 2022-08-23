<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function index()
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required',
        // ]);

        // if(Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }

        // return back()->with('loginError', 'Login gagal!');

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.index');
            } else if (auth()->user()->role == 'user') {
                return redirect()->route('user.index');
            }
        } else {
            return back()->with('loginError', 'Login gagal!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registration(Request $request)
    {
        $validateData = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);


            // $acakPass = setPasswordAttribute($request->input('password'));
            // $password = password_hash($request->input('password'), PASSWORD_DEFAULT);

            $user = User::create([
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 1,
            ]);

            $user->save();

            $request->session()->flash('success', 'Akun Berhasil Didaftarkan.');
            return redirect('/login');
    }    
}
