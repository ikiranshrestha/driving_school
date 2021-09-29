<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AddCourseController;
use App\Http\Controllers\AddCoursePackageController;
use App\Models\CoursePackage;
use App\Models\Enrollment;

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


Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
Route::post('/admission', [AdmissionController::class, 'processForm']);


Route::get('/enroll', [EnrollmentController::class, 'index'])->name('enrollment');
Route::get('/getPackagesByCourse', [EnrollmentController::class, 'loadPackagesByCourse'])->name('loadPackagesByCourse');
Route::get('/getPackagePrice', [EnrollmentController::class, 'loadPackagePrice'])->name('loadPackagePrice');
Route::post('/enroll', [EnrollmentController::class, 'processForm']);
Route::get('/activeEnrollments', [EnrollmentController::class, 'activeEnrollments'])->name('activeEnrollments');

Route::get('/add_course', [AddCourseController::class, 'index'])->name('add_course');
Route::post('/add_course', [AddCourseController::class, 'processForm']);

Route::get('/add_coursepackage', [AddCoursePackageController::class, 'index'])->name('addPackages');
Route::post('/add_coursepackage', [AddCoursePackageController::class, 'processForm']);

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('dashboard');
Route::get('/layout', function(){
    return view('admin.forms.layout_copy');
});

