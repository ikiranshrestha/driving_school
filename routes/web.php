<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AddCourseController;
use App\Http\Controllers\AddCoursePackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\UserAuthController;
use App\Mail\WelcomeMail;
use App\Models\Trainee;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/',function(){
        // return view('admin.dashboard');
        return redirect()->route('dashboard');
    });
    Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
    Route::post('/admission', [AdmissionController::class, 'processForm']);
    Route::get('/admission/trainee-list', [AdmissionController::class, 'listAllAdmissions'])->name('admission.trainee_list');
    Route::get('/admission/edit-trainee/{id}', [AdmissionController::class, 'editTrainee'])->name('admission.edit_trainee');
    Route::post('/admission/edit-trainee/{id}', [AdmissionController::class, 'updateTrainee'])->name('admission.update_trainee');
    Route::get('/getDiscountPrice', [EnrollmentController::class, 'getDiscountPrice'])->name('getDiscountPrice');

    Route::get('/enroll', [EnrollmentController::class, 'index'])->name('enrollment');
    Route::get('/getPackagesByCourse', [EnrollmentController::class, 'loadPackagesByCourse'])->name('loadPackagesByCourse');
    Route::get('/getPackagePrice', [EnrollmentController::class, 'loadPackagePrice'])->name('loadPackagePrice');
    Route::post('/enroll', [EnrollmentController::class, 'processForm']);
    Route::get('/activeEnrollments', [EnrollmentController::class, 'activeEnrollments'])->name('activeEnrollments');
    Route::get('enrollment/search', [EnrollmentController::class, 'searchEnrollments'])->name('enrollment.search');

    Route::get('/add_course', [AddCourseController::class, 'index'])->name('add_course');
    Route::post('/add_course', [AddCourseController::class, 'processForm']);
    Route::get('/availablecourses', [AddCourseController::class, 'availablecourses'])->name('availablecourses');

    Route::get('/add_coursepackage', [AddCoursePackageController::class, 'index'])->name('addPackages');
    Route::post('/add_coursepackage', [AddCoursePackageController::class, 'processForm']);
    Route::get('/availablepackages', [AddCoursePackageController::class, 'availablepackages'])->name('availablepackages');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('stats');

    Route::get('/auth/login', [UserAuthController::class, 'login'])->name('auth.login');
    Route::post('/auth/login', [UserAuthController::class, 'processLogin'])->name('auth.processLogin');
    
    Route::get('/reports/admission-vs-enrollment', [ReportController::class, 'admissionVsEnrollment'])->name('report.ad_vs_en');
    Route::get('reports/income-sheet', [ReportController::class, 'incomeByMonth'])->name('report.income_by_month');
    
    Route::get('trainee-evaluation/{id}', [ReportController::class, 'evaluateTrainee'])->name('evaluate_trainee');
    Route::post('trainee-evaluation/{id}', [ReportController::class, 'storeTraineeEvaluation'])->name('store_evaluate_trainee');
    Route::get('view-trainee-progress/{id}', [ReportController::class, 'viewTraineeProgress'])->name('view_trainee_progress');
});

Route::get('/trainee', [TraineeController::class, 'login'])->name('trainee.login');
Route::post('/trainee/login', [TraineeController::class, 'processLogin'])->name('trainee.processLogin');
Route::get('/trainee/dashboard', [TraineeController::class, 'dashboard'])->name('trainee.dashboard');
Route::get('/trainee/progress-report', [TraineeController::class, 'progressReport'])->name('trainee.progressReport');

Route::get('/auth/logout', [UserAuthController::class, 'logout'])->name('auth.logout');

Route::get('/algo', [RecommendationController::class, "recommendCourses"]);
Route::get('/phonetic', [TraineeController::class, "performSearch"]);