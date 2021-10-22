<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddCourseController extends Controller
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
        return view('admin.forms.add_course', ['LoggedInUserData' => $LoggedInUserData]);
    }
    public function processForm(Request $request)
    {
        $request->validate([
            'course_type' => 'required',
            'vehicle_category' => 'required'
        ]);
        $data['course_type'] = $request->course_type;
        $data['vehicle_category'] = $request->vehicle_category;
        DB::table('courses')->insert($data);
        return redirect()->back()->with('success', 'Course Added Successfully!');

    }
    public function availablecourses(Request $request)
    {
        $LoggedInUserData = ['LoggedInUserInfo'=>
                            Admin::where('id', session('LoggedInUser'))->first()
                            ];
        $availablecourses = DB::table('courses')
        ->select('*')
        ->get()->sortBy('p_cid');
        // ddd($availablecourses);
        return view('admin.tables.availablecourses', ['LoggedInUserData' => $LoggedInUserData ,'courseInfo' => $availablecourses]);

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
