<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $equipments = $request->get("equipments");
        $equipmentsArray = explode(',', $equipments); // Split the string by commas to create an array
        $jsonString = json_encode($equipmentsArray);
        $request->merge(['equipment' => $jsonString]);

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "intensity" => "required|int|max:255|in:1,2,3,4",
            'equipments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        $data['name'] = $request->name;
        // $data['uname'] = $request->lname . hash('adler32', time());
        $data['description'] = $request->description;
        $data['intensity'] = $request->intensity;
        // $data['equipment_needed'] = $request->equipments;

        $lasid = DB::table('courses')->insertGetId($data);

        if(!$lasid)
        {
            return redirect()->back()->with('error', 'Something went wrong!');

        }else{
            return redirect()->route('add_course')->with('success', 'Fitness Class Added!');
        }
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
