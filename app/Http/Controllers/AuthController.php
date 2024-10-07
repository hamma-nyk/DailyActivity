<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public function register(){
        return view('auth.register');
    }

    public function registerSave(Request $request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 0
        ]);

        return redirect()->route('login');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginSave(Request $request){
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        
        $request->session()->regenerate();
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin.home');
            //return response()->json(['message' => Auth::user()->type]);
        }else{
            return redirect()->route('home');
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        return redirect()->route('login');
    }
}
