<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Modify the queries for optimization and efficiency
        $LoggedInUserData = ['LoggedInUserInfo'=>
                            Admin::where('id', session('LoggedInUser'))->first()
                            ];
        // ddd($LoggedInUserData);
        $titleAllTime = "All Time";
        $totalAdmissions = Admission::all()->count();
        $totalEnrollments = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereRaw('e_startdate <= ?', [date('Y-m-d')])
        ->count();
        $totalPendingEnrollments = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereRaw('e_startdate > ?', [date('Y-m-d')])
        ->count();
        $totalTraineeSessions = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereRaw('e_startdate <= ?', [date('Y-m-d')])
        ->count();


        $titleToday = "Today";
        $todayAdmissions = Admission::where('admission_date', '=', date('Y-m-d'))->count();
        $todayEnrollments = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->where('e_startdate', '=', date('Y-m-d'))
        ->count();
        $todayTraineeSessions = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereRaw('e_startdate <= ?', [date('Y-m-d')])
        ->whereRaw('e_startdate + INTERVAL p_duration DAY >= ?', [date('Y-m-d')])
        ->count();

        $titleThisWeek = "This Week";
        $todayDate = date('Y-m-d');
        $todayMinus7Days = date('Y-m-d', strtotime('-7 day'));
        $admissionsThisWeek = Admission::whereBetween('admission_date', [$todayMinus7Days, $todayDate
        ])->count();
        $enrollmentsThisWeek = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereBetween('e_startdate', [$todayMinus7Days, $todayDate
        ])
        ->count();
        $trainingSessionsThisWeek = DB::table('enrollments')
        ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
        ->whereBetween('e_startdate', [$todayMinus7Days, $todayDate
        ])
        ->count();

        // ddd($this->getAverageLearningTrend());

        return view('admin.dashboard', ['LoggedInUserData' => $LoggedInUserData], ['titleAllTime' => $titleAllTime, 'totalAdmissions' => $totalAdmissions, 'totalEnrollments' => $totalEnrollments, 'totalPendingEnrollments' => $totalPendingEnrollments, 'totalTraineeSessions' => $totalTraineeSessions, 'titleToday' => $titleToday, 'todayAdmissions' => $todayAdmissions, 'todayEnrollments' => $todayEnrollments, 'todayTraineeSessions' => $todayTraineeSessions, 'titleThisWeek' => $titleThisWeek, 'admissionsThisWeek' => $admissionsThisWeek, 'enrollmentsThisWeek' => $enrollmentsThisWeek, 'trainingSessionsThisWeek' => $trainingSessionsThisWeek]);
    }

    public function rawQueryGenerator($operation, $column, $alias)
    {
        return DB::raw("ROUND($operation($column)) as $alias");
    }
     
    public function getAverageLearningTrend()
    {
        return $progressReport = DB::table('trainee_evaluations')->select($this->rawQueryGenerator('AVG', 'eight_boundary_violations', 'eight'))->get();
        // ddd($all);
        // return view('trainee.reports.progress_report', ['ProgressReport' => $progressReport]);
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
