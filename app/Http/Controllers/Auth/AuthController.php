<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Show Login Form.
     *
     * @return string
     */
    public function index()
    {
        return view('pages.auth.login', [
            "page_title" => "Login",
            "page_description" => "Storage app login page",
            "layout" => "blank"
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return string
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (auth()->attempt($login)) {
            return redirect()->route('index');
        }
        return redirect()->route('login')
            ->withInput($request->input())
            ->with(['error' => 'Username/Password salah!']);
    }

    /**
     * Logout from application.
     *
     * @return string
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route("login");
    }
}
