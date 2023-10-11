<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        public function evaluateTrainee(Request $request){
            return view('admin.forms.evaluate_trainee');
        }

        public function storeTraineeEvaluation(Request $request, int $id){
            // $enrollId = Enrollment::join('admissions', 'admissions.a_uid', '=' 'enrollments.id')->where('trainee_id', $request->trainee_id)->orderBy('e_startdate', 'DESC')->first();
            $enrollId = DB::table('enrollments')->select('enrollments.id')
            ->join('admissions', 'admissions.id', '=', 'enrollments.e_aid')
            ->join('trainees', 'trainees.id', '=', 'admissions.a_uid')
            ->where('trainees.id', '=', $id)
            ->orderByDesc('e_startdate')->first()->id;

            $data['trainee_id'] = $id;
            $data['enroll_id'] = $enrollId;
            $data['weight'] = $request->weight;
            $data['chest'] = $request->chest;
            $data['biceps'] = $request->biceps;
            $data['stomach'] = $request->stomach;
            $data['waist'] = $request->waist;
            $data['hip'] = $request->hip;
            $data['thigh'] = $request->thigh;
            $data['calves'] = $request->calves;
            $data['created_at'] = Carbon::now();
            // ddd($data);
            DB::table('trainee_evaluations')->insert($data);
        }

        public function viewTraineeProgress(Request $request){
            // ddd($request->id);
            // $progress = DB::table('trainee_evaluations')->join('enrollments', 'enrollments.id', '=', 'trainee_evaluations.enroll_id')->join('trainees', 'trainee_id', '=', 'trainee_evaluations.trainee_id')->where('trainee_id', '=', $request->id)->toSql();
            $progress = DB::table('trainee_evaluations')->join('enrollments', 'enrollments.id', '=', 'trainee_evaluations.enroll_id')->where('trainee_id', '=', $request->id)->get();
            // ddd($progress);
            return view('admin.reports.progress_report', ['ProgressList' => $progress]);
        }
}