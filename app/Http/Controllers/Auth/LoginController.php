<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function myLogin(Request $request)
    {
        $input = $request->all();
        // dd($users->is_active);

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd($user);

        
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_active != 1) {
                Auth::logout();
                return back()->with('loginError', 'Akun belum diaktifkan!');
            }
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
}
