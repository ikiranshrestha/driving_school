<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Admin;
use Illuminate\Validation\Rule;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LoggedInUserData = ['LoggedInUserInfo'=>
                            Admin::where('id', session('LoggedInUser'))->first()
                            ];
        return view('admin.forms.admission', ['LoggedInUserData' => $LoggedInUserData]);
    }


    public function processForm(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            // 'mname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'email' => ['required', Rule::unique('trainees', 't_email')],
            'phone' => ['required', Rule::unique('trainees', 't_phone')],
            'bloodgroup' => 'required',
        ]);
        $data['t_fname'] = $request->fname;
        $data['t_mname'] = $request->mname;
        $data['t_lname'] = $request->lname;
        $data['t_uname'] = $request->lname . hash('adler32', time());
        $data['t_secretkey'] = hash('adler32', $data['t_uname']);
        $data['t_dob'] = $request->dob;
        $data['t_email'] = $request->email;
        $data['t_phone'] = $request->phone;
        $data['t_bloodgroup'] = $request->bloodgroup;

        $last_id = DB::table('trainees')->insertGetId($data);

        $admissionData['a_uid'] = $last_id;
        $admissionData['admission_date'] = date("Y-m-d");

        DB::table('admissions')->insert($admissionData);
        $to_email = $data['t_email'];
        $dataForEmail = [
            'name' => $data['t_fname'] . " " .$data['t_mname'] . " " .$data['t_lname'],
            'username' => $data['t_uname'],
            'secretkey' => $data['t_secretkey']
        ];
        $sendEmail = Mail::to($to_email)->send(new WelcomeMail($dataForEmail));
        if(count(Mail::failures()) > 0)
        {
            return redirect()->back()->with('error', 'Something went wrong!');

        }else{
            return redirect()->route('admission')->with('success', 'Admitted and Notified!');
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
