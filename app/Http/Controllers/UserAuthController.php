<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');     
    }
    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $userInfo = Admin::where('email', '=', $request->email)->first();
        if(!$userInfo){
            return redirect()->back()->with('error', "Unrecognized email: $request->email");
            // return redirect()->back()->with('success', 'Enrolled and Notified!');
        }
        else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedInUser', $userInfo->id);
                return redirect('dashboard');
            }else{
                return redirect()->back()->with('error', 'Invalid Password');
            }
        }
    }

    public function logout()
    {
        if(session()->has('LoggedInUser')){
            session()->pull('LoggedInUser');
            return redirect('auth/login');
        }
    }
}
