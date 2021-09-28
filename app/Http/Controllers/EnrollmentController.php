<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\CoursePackage;
use App\Models\Admission;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseData = DB::table('courses')->select('*')->get();
        $timeData = DB::table('time')->select('*')->get();

        return view('admin.forms.enrollment', ['courseList' => $courseData, 'timeList' => $timeData]);
    }
    
    public function loadData()
    {
        $courseData = DB::table('courses')->select('*')->get();
        $timeData = DB::table('time')->select('*')->get();

        return view('admin.forms.enrollment', ['courseList' => $courseData, 'timeList' => $timeData]);
    }
    
    public function loadPackagesByCourse(Request $request){
        $data = CoursePackage::select('*')->where('p_cid', $request->id)->get();
        return response()->json($data);
    }
    public function loadPackagePrice(Request $request){
        $data = CoursePackage::select('p_cost')->where('id', $request->id)->get();
        return response()->json($data);
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
