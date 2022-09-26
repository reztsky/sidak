<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function auth(Request $request){
        $credenstials=$request->validate([
            'user'=>'required',
            'password'=>'required',
        ]);

        if(Auth::attempt($credenstials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->with('message','Failed Login Check Username and Password');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
     
        return redirect()->route('login');
    }
}
