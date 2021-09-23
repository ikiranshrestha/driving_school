<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AddCourseController;
use App\Http\Controllers\AddCoursePackageController;

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

// Route::get('/admission', function(){
//     return view('forms.admission');
// });

Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
Route::post('/admission', [AdmissionController::class, 'processForm']);

// Route::get('/enroll', [EnrollmentController::class, 'index'])->name('enroll');
Route::get('/enroll', [EnrollmentController::class, 'index'])->name('enroll');

Route::get('/enroll', [EnrollmentController::class, 'loadData'])->name('loadCoursesAndTime');

Route::get('/add_course', [AddCourseController::class, 'index'])->name('add_course');
Route::post('/add_course', [AddCourseController::class, 'processForm']);

Route::get('/add_coursepackage', [AddCoursePackageController::class, 'index'])->name('addPackages');
Route::post('/add_coursepackage', [AddCoursePackageController::class, 'processForm']);

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});
Route::get('/layout', function(){
    return view('admin.forms.layout_copy');
});

