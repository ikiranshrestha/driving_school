<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;

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
