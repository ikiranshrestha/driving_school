<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Admin;
use App\Models\Trainee;
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
        $data['t_description'] = $request->description;

        $last_id = DB::table('trainees')->insertGetId($data);

        $recommendationAlgo = new RecommendationController();

        $recommendationCourse = $recommendationAlgo->recommendCourses($request->description);
        // dd($recommendationCourse);
        $recommendationCourse = $recommendationCourse->original["courses"][0];

        $recommendationCourseName = $recommendationCourse->name;
        $recommendationCourseDesc = $recommendationCourse->description;
        $recommendationCourseId = $recommendationCourse->id;

        $recommendedCoursePackages = DB::table('coursepackages')->where('p_cid', $recommendationCourseId)->select('*')
            ->get()->sortBy('p_cid');
        // dd(gettype($recommendedCoursePackages), $recommendedCoursePackages);
        $admissionData['a_uid'] = $last_id;
        $admissionData['admission_date'] = date("Y-m-d");

        DB::table('admissions')->insert($admissionData);
        $to_email = $data['t_email'];
        $dataForEmail = [
            'name' => $data['t_fname'] . " " .$data['t_mname'] . " " .$data['t_lname'],
            'username' => $data['t_uname'],
            'secretkey' => $data['t_secretkey'],
            'recommendedCourse' => $recommendationCourseName,
            'recommendedCourseDesc' => $recommendationCourseDesc,
            'recommendedCoursePackage' => $recommendedCoursePackages,
        ];
        $sendEmail = Mail::to($to_email)->send(new WelcomeMail($dataForEmail));
        if(count(Mail::failures()) > 0)
        {
            return redirect()->back()->with('error', 'Something went wrong!');

        }else{
            return redirect()->route('admission')->with('success', 'Admitted and Notified!');
        }
    }

    public function listAllAdmissions()
    {
        $admittedTrainees = Trainee::join('admissions', 'trainees.id', '=', 'admissions.a_uid')->paginate(5);
        // ddd($admittedTrainees);
        return view('admin.tables.admitted_trainees', ['admittedTrainees' => $admittedTrainees]);
    }

    public function searchAdmissions(Request $request)
{
    $LoggedInUserData = [
        'LoggedInUserInfo' =>
            Admin::where('id', session('LoggedInUser'))->first()
    ];

    $searchQuery = $request->input('search');

    // Perform a phonetic search on the `trainees` table.
    $admittedTrainees = Trainee::join('admissions', 'trainees.id', '=', 'admissions.a_uid')
        ->select('trainees.t_fname', 'trainees.t_lname', 'trainees.t_mname', 'trainees.t_uname', 'trainees.id as tr_id', 'trainees.t_phone', 'admissions.admission_date')
        ->whereRaw('SOUNDEX(trainees.t_fname) = SOUNDEX(?) OR SOUNDEX(trainees.t_lname) = SOUNDEX(?) OR SOUNDEX(trainees.t_mname) = SOUNDEX(?) OR SOUNDEX(trainees.t_uname) = SOUNDEX(?)', [$searchQuery, $searchQuery, $searchQuery, $searchQuery])
        ->orderBy('admissions.admission_date', 'DESC')
        ->paginate(5);

    return view(
        'admin.tables.admitted_trainees',
        ['LoggedInUserData' => $LoggedInUserData, 'admittedTrainees' => $admittedTrainees]
    );
}

    public function editTrainee(Request $request)
    {
        $admittedTrainees = Trainee::join('admissions', 'trainees.id', '=', 'admissions.a_uid')->where('trainees.id', '=', $request->id)->first();
        // ddd($admittedTrainees);
        // $admittedTrainees = Trainee::join('admissions', 'trainees.id', '=', 'admissions.a_uid')->paginate(5);
        // ddd($admittedTrainees);
        return view('admin.forms.edit_trainee', ['admittedTrainees' => $admittedTrainees]);
    }

    public function updateTrainee(Request $request)
    {
        $data['t_fname'] = $request->fname;
        $data['t_mname'] = $request->mname;
        $data['t_lname'] = $request->lname;
        $data['t_uname'] = $request->lname . hash('adler32', time());
        $data['t_secretkey'] = hash('adler32', $data['t_uname']);
        $data['t_dob'] = $request->dob;
        $data['t_email'] = $request->email;
        $data['t_phone'] = $request->phone;
        $data['t_bloodgroup'] = $request->bloodgroup;
        // $trainee = new Trainee();
        DB::table('trainees')->where('id', '=', $request->id)->update($data);
        return redirect()->route('admission.edit_trainee', $request->id)->with('success', 'Successfully Updated!');
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
