<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\CoursePackage;
use App\Models\Admission;
use App\Models\Enrollment;
use App\Models\Trainee;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrollMail;
use App\Helpers\EnrollmentEmailHelper;
use App\Models\Admin;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LoggedInUserData = [
            'LoggedInUserInfo' =>
                Admin::where('id', session('LoggedInUser'))->first()
        ];
        $courseData = DB::table('courses')->select('*')->get();
        $timeData = DB::table('time')->select('*')->get();

        return view(
            'admin.forms.enrollment',
            ['courseList' => $courseData, 'timeList' => $timeData, 'LoggedInUserData' => $LoggedInUserData]
        );
    }

    public function loadData()
    {
        $courseData = DB::table('courses')->select('*')->get();
        $timeData = DB::table('time')->select('*')->get();

        return view('admin.forms.enrollment', ['courseList' => $courseData, 'timeList' => $timeData]);
    }

    public function loadPackagesByCourse(Request $request)
    {
        $data = CoursePackage::select('*')->where('p_cid', $request->id)->get();
        return response()->json($data);
    }

    public function loadPackagePrice(Request $request)
    {
        $data = CoursePackage::select('p_cost')->where('id', $request->id)->get();
        return response()->json($data);
    }

    public function processForm(Request $request)
    {
        //TODO: Remove logical error in enrollment email; issues in - start date, end date
        $request->validate([
            'uname' => 'required',
            'e_cid' => 'required',
            'e_pid' => 'required',
            'e_startdate' => 'required',
            'e_tmid' => 'required',
            'p_fee' => 'required'
        ]);

        $uname = $request->uname;

        if (Trainee::where('t_uname', $uname)->exists()) {
            $e_aid = DB::table('trainees')
                ->rightJoin('admissions', 'trainees.id', '=', 'admissions.a_uid')
                ->select('admissions.id', 't_email')->where('t_uname', $uname)->first();
            $data['e_aid'] = $e_aid->id;
            $data['e_cid'] = $request->e_cid;
            $data['e_pid'] = $request->e_pid;
            $data['e_startdate'] = $request->e_startdate;
            $data['e_tmid'] = $request->e_tmid;
            $data['p_fee'] = $request->p_fee;
            $trainee_email = $e_aid->t_email;
            // ddd($trainee_email)

            $coursepackages = DB::table('coursepackages')
                ->rightJoin('courses', 'coursepackages.p_cid', '=', 'courses.id')
                ->select('course_type', 'p_name', 'p_duration')
                ->where('coursepackages.id', '=', $data['e_pid'])
                ->first();
            // ddd($coursepackages);

            $time = DB::table('time')
                ->select('time')
                ->where('time.id', '=', $data['e_tmid'])->first();
            // ddd($time->time);
            $sessionTime = $time->time;
            // ddd($sessionTime);

            if ($count = Enrollment::where('e_aid', '=', $data['e_aid'])->count() > 0) {
                //record exists in enrollment, so check active or not
                if ($abc = DB::table('enrollments')->join(
                    'coursepackages',
                    'enrollments.e_pid',
                    '=',
                    'coursepackages.id'
                )
                    ->select('*')
                    ->where('e_aid', '=', $data['e_aid'])
                    ->whereRaw('enrollments.e_startdate + interval coursepackages.p_duration day >= ?', [date('Y-m-d')]
                    )->first()) {
                    return redirect()->back()->with(
                        'error',
                        'Active Enrollment exists! Cannot enroll while one enrollment is ongoing.'
                    );
                } else {
                    DB::table('enrollments')->insert($data);
                    $notifyEnroll = sendEnrollmentNotification(
                        $trainee_email,
                        $uname,
                        $coursepackages,
                        $data['e_startdate'],
                        $sessionTime
                    );
                    if ($notifyEnroll) {
                        return redirect()->back()->with('success', 'Enrolled and Notified!');
                    } else {
                        return redirect()->back()->with('error', 'Email not sent!');
                    }
                }
            } else {
                DB::table('enrollments')->insert($data);
                $notifyEnroll = sendEnrollmentNotification(
                    $trainee_email,
                    $uname,
                    $coursepackages,
                    $data['e_startdate'],
                    $sessionTime
                );
                if ($notifyEnroll) {
                    return redirect()->back()->with('success', 'Enrolled and Notified!');
                } else {
                    return redirect()->back()->with('error', 'Email not sent!');
                }
                // return redirect()->back()->with('success', 'Enrolled');
            }
        } else {
            return redirect()->back()->with('error', "{$uname}: No Such User!");
        }
    }

    public function activeEnrollments(Request $request)
    {
        $LoggedInUserData = [
            'LoggedInUserInfo' =>
                Admin::where('id', session('LoggedInUser'))->first()
        ];
        $activeEnrollments = DB::table('enrollments')
            ->join('coursepackages', 'enrollments.e_pid', '=', 'coursepackages.id')
            ->join('courses', 'coursepackages.p_cid', '=', 'courses.id')
            ->join('admissions', 'enrollments.e_aid', '=', 'admissions.id')
            ->join('trainees', 'admissions.a_uid', '=', 'trainees.id')
            ->select('*')
            ->whereRaw('enrollments.e_startdate + interval coursepackages.p_duration day >= ?', [date('Y-m-d')])
            ->get()->sortBy('e_startdate');
        // ddd($activeEnrollments);
        return view(
            'admin.tables.activeenrollments',
            ['LoggedInUserData' => $LoggedInUserData, 'enrollmentInfo' => $activeEnrollments]
        );
    }

    /*
 * 1. Check if he's recurring customer
 * 2. If yes, go to 3, else go to 7
 * 3. Check the number of times he has enrolled for different courses
 * 4. If number of times enrolled is greater than or equal to one, discount = 5%,
 *      else If the number times enrolled is greater than one, discount is 8%
 * 5. If the total amount spent so far is greater than Rs 10000 and less than Rs 15000, additional discount = 2%,
 *      else If the number of times enrolled is greater than Rs 15000, additional discount = 5%
 * 6. Reduce the discount amount from offered price
 * 7. Exit
 * */

    public function getLoyaltyDiscount($id)
    {
        return $this->totalApplicableDiscount($id);
    }

    public function totalApplicableDiscount($id)
    {
        $discountRedeemable = $this->getDiscountByEnrollmentCount($id) + $this->getDiscountByTotalAmountPaid($id);
        return $totalRedeemable = $discountRedeemable + $this->governFestivalOffers();
    }

    public function governFestivalOffers()
    {
        $governFestivalOffer = 0;
        if (date('m') == 10 || date('m') == 11 || date('m') == 8) {
            $governFestivalOffer = 5;
        } elseif (date('m') == 5 || date('m') == 6) {
            $governFestivalOffer = -10;
        }
        return $governFestivalOffer;
    }

    public function getDiscountByEnrollmentCount($id)
    {
        $discount_percent = 0;
        $traineeId = $id;
        // $enroll_count = DB::table('Enrollments')->where('id', '=', $id)->count('id');
        $enroll_count = DB::table('admissions')->select(DB::raw('COUNT(enrollments.id) as enrollCount'))->join('trainees', 'trainees.id', '=', 'admissions.a_uid')
        ->join('enrollments', 'admissions.id', '=', 'enrollments.e_aid')
        ->where('trainees.id', '=', $traineeId)->first()->enrollCount;
        if ($enroll_count == 1) {
            $discount_percent = 5.0;
        } elseif ($enroll_count >= 2) {
            $discount_percent = 8.0;
        }
        return $discount_percent;
    }

    public function getDiscountByTotalAmountPaid($id)
    {
        $discount_percent = 0;
        $traineeId = $id;
        // $amount_paid = DB::table('Enrollments')->where('e_aid', '=', $id)->sum('p_fee');
        $amount_paid = DB::table('admissions')->select(DB::raw('SUM(enrollments.p_fee) as enrollTotalPay'))->join('trainees', 'trainees.id', '=', 'admissions.a_uid')
        ->join('enrollments', 'admissions.id', '=', 'enrollments.e_aid')
        ->where('trainees.id', '=', $traineeId)->first()->enrollTotalPay;
        if ($amount_paid >= 5000 && $amount_paid <= 15000) {
            $discount_percent = 2;
        } elseif ($amount_paid > 15000) {
            $discount_percent = 5;
        }
        return $discount_percent;
    }

    //getDiscountPrice
    public function getDiscountPrice(Request $request){
        if($request->ajax()){
            if($request->package_id != null){
                $package_id = $request->package_id;
                $package = CoursePackage::findOrfail($package_id);
                $uname = $request->user;
                // return $uname;

                    // $traineeId = DB::table('trainees')->select('id')->where('t_uname', $request->user)->get();
                    // $traineeId = DB::table('trainees')
                    // ->where('t_uname', '=', $request->user)
                    // ->get();
                    // $traineeId =  DB::table('trainees')->select('*')->where('t_uname', '=', $uname)->get();
                    $traineeId =  DB::table('trainees')->select('id')->where('t_uname', '=', $uname)->first()->id;
                    // ddd($traineeId);
                    $loyaltyDiscountInPercent = $this->getLoyaltyDiscount($traineeId);
                    if($loyaltyDiscountInPercent > 0){
                        $packageCost = $package->p_cost;
                        $loyaltyDiscountInFigure = $packageCost - ($packageCost * ($loyaltyDiscountInPercent / 100));
                        return "Offered Cost After Loyalty Discount <strong>Rs." . $loyaltyDiscountInFigure . "<strong/>" .
                        "<br/>[$loyaltyDiscountInPercent% Discount]";
                    }
            }
        }
    }
}
