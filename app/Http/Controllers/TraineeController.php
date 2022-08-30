<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TraineeController extends Controller
{
    public function login()
    {
        return view('trainee.login');     
    }
    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'secret_key' => 'required'
        ]);
        // $userInfo = Trainee::where('t_uname', '=', $request->username)->first();
        $traineeInfo = Trainee::where('t_uname', '=', $request->username)->first();
        // ddd($traineeInfo);
        if(!$traineeInfo){
            return redirect()->back()->with('error', "Unrecognized email: $request->email");
        }
        else{
            if(Trainee::where('t_secretkey', '=', $request->secret_key)->first()){
                $request->session()->put('LoggedInUser', $traineeInfo->id);
                return redirect()->route('trainee.dashboard');
            }else{
                return redirect()->back()->with('error', 'Invalid Password');
            }
        }
    }

    public function dashboard(Request $request)
    {
        $sessionId = Session::get('LoggedInUser');
        // ddd($sessionId);
        $traineeInfo = DB::table('trainees')->join('admissions', 'admissions.a_uid', '=', 'trainees.id')
                        ->join('enrollments', 'enrollments.e_aid', '=', 'admissions.id')
                        ->join('courses', 'courses.id', '=', 'enrollments.e_cid')
                        ->join('coursepackages', 'coursepackages.id', '=', 'enrollments.e_pid')
                        ->where('trainees.id', '=', $sessionId)->get();
        // $courseType = $traineeInfo->t_fname . ' ' . $traineeInfo->t_mname  .  ' ' . $traineeInfo->t_lname;
        // ddd($traineeInfo);
        // ddd($traineeInfo->toSql());
        return view('trainee.dashboard', ['enrollment_history' => $traineeInfo]);     
    }


    // public function progressReport()
    // {
    //     ddd(Auth::id());
    //     $all = DB::table('trainee_evaluations')->get();
    //     ddd($all);
    //     return view('trainee.reports.progress_report');
    // }
}
