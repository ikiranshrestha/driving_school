<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AddCourseController;
use App\Http\Controllers\AddCoursePackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAuthController;
use App\Mail\WelcomeMail;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
    Route::post('/admission', [AdmissionController::class, 'processForm']);


    Route::get('/enroll', [EnrollmentController::class, 'index'])->name('enrollment');
    Route::get('/getPackagesByCourse', [EnrollmentController::class, 'loadPackagesByCourse'])->name('loadPackagesByCourse');
    Route::get('/getPackagePrice', [EnrollmentController::class, 'loadPackagePrice'])->name('loadPackagePrice');
    Route::post('/enroll', [EnrollmentController::class, 'processForm']);
    Route::get('/activeEnrollments', [EnrollmentController::class, 'activeEnrollments'])->name('activeEnrollments');

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
});

Route::get('/auth/logout', [UserAuthController::class, 'logout'])->name('auth.logout');