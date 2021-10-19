<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Course;

class AddCoursePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $courseData = DB::table('courses')->select('*')->get();
        $courseData = Course::all();
        return view('admin.forms.add_coursepackage', ['courseList' => $courseData]);

    }
    public function availablePackages(Request $request)
    {
        $availablepackages = DB::table('courses')
        ->join('coursepackages', 'courses.id', '=', 'coursepackages.p_cid')
        ->select('*')
        ->get()->sortBy('p_cid');
        // ddd($availablepackages);
        return view('admin.tables.availablepackages', ['packageInfo' => $availablepackages]);

    }

    public function processForm(Request $request)
    {
        $request->validate([
            'p_name' => 'required',
            'p_cid' => 'required',
            'p_duration' => 'required',
            'p_cost' => 'required',
        ]);

        $packageData['p_name'] = $request->p_name;
        $packageData['p_cid'] = $request->p_cid;
        $packageData['p_duration'] = $request->p_duration;
        $packageData['p_cost'] = $request->p_cost;

        DB::table('coursepackages')->insert($packageData);
        return redirect()->back()->with('success', 'Package Added Successfully!');

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
