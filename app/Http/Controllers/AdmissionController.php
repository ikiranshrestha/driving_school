<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.forms.admission');
    }


    public function processForm(Request $request)
    {
        
        $name = "Hamro Ramro";

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

        
        // ddd($last_id);
        $admissionData['a_uid'] = $last_id;
        $admissionData['admission_date'] = date("Y-m-d");

        DB::table('admissions')->insert($admissionData);

        
        $to_email = $data['t_email'];
        $subject = "Your username and password";
        $body = "Welcome to {$name} Driving School!\nHello {$data['t_fname']},\n\nYou have recently been admitted to the driving school. Please take your attendance credentials.\n";
        $body .= "\nUsername: {$data['t_uname']}\nPassword: {$data['t_secretkey']}";
        $headers = "From: KS";
        
        if (mail($to_email, $subject, $body, $headers)) {
            return "Email successfully sent to $to_email...";
        } else {
            return "Email sending failed...";
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
