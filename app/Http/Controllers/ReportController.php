<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function admissionVsEnrollment(){
        $enrollmentCount = DB::table('enrollments')->select((DB::raw('count(MONTH(e_startdate)) AS enrollCount, MONTH(e_startdate) AS monthCount, YEAR(e_startdate) AS Year')))->groupBy(DB::raw('MONTH(e_startdate)'), DB::raw('YEAR(e_startdate)'))->get();
        $admissionCount = DB::table('admissions')->select((DB::raw('count(MONTH(admission_date)) AS admissionCount, MONTH(admission_date) AS monthCount, YEAR(admission_date) AS Year')))->groupBy(DB::raw('MONTH(admission_date)'), DB::raw('YEAR(admission_date)'))->get();

        $totalNumberOfEnrollments = DB::table('enrollments')->select((DB::raw('count(*) AS totalEnrollments')))->first()->totalEnrollments;
        $totalNumberOfAdmissions = DB::table('admissions')->select((DB::raw('count(*) AS totalAdmissions')))->first()->totalAdmissions;
        // ddd($enrollmentCount);
        return view('admin.reports.enrollment_vs_admission', ['EnrollmentCount' => $enrollmentCount, 'AdmissionCount' => $admissionCount, 'TotalEnrollments' => $totalNumberOfEnrollments, 'TotalAdmissions' => $totalNumberOfAdmissions]);
    }

    public function incomeByMonth(){
        $income = DB::table('enrollments')->select((DB::raw('SUM(p_fee) AS income, MONTH(e_startdate) AS monthCount, YEAR(e_startdate) AS Year')))->groupBy(DB::raw('MONTH(e_startdate)'), DB::raw('YEAR(e_startdate)'))->orderByDesc('e_startdate')->get();
        // ddd($income);
        return view('admin.reports.monthly_income', ['Income' => $income]);
    }
        // return view('admin.reports.enrollment_vs_admission', ['EnrollmentCount' => $enrollmentCount, 'AdmissionCount' => $admissionCount]);
    }