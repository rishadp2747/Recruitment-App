<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'add'])->name('addJob')->middleware('verified');

Route::post('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'addtodb'])->name('addJob')->middleware('verified');

Route::get('/dashboard/jobs/view', [App\Http\Controllers\jobsController::class, 'view'])->name('viewJob')->middleware('verified');

Route::get('/dashboard/jobs/update', [App\Http\Controllers\jobsController::class, 'update'])->name('updateJob')->middleware('verified');

Route::get('/dashboard/jobs/update/{id}', [App\Http\Controllers\jobsController::class, 'updateview'])->middleware('verified');

Route::post('/dashboard/jobs/update/it', [App\Http\Controllers\jobsController::class, 'updatefromdb'])->name('updateJobDB')->middleware('verified');

Route::get('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'delete'])->name('deleteJob')->middleware('verified');

Route::post('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'deletefromdb'])->name('deleteJob')->middleware('verified');

Route::get('/dashboard/jobs/student/view', [App\Http\Controllers\studentJobsController::class, 'view'])->name('availableJobs')->middleware('verified');

Route::get('/dashboard/jobs/student/apply/{id}', [App\Http\Controllers\studentJobsController::class, 'applyview'])->middleware('verified');

Route::get('/dashboard/jobs/student/applied/{id}', [App\Http\Controllers\studentJobsController::class, 'appliedview'])->middleware('verified');

Route::get('/dashboard/jobs/company/applied/{id}', [App\Http\Controllers\jobsController::class, 'appliedinfo'])->middleware('verified');

Route::post('/dashboard/jobs/student/apply', [App\Http\Controllers\studentJobsController::class, 'applytodb'])->name('applyJob')->middleware('verified');

Route::get('/dashboard/jobs/student/applied', [App\Http\Controllers\studentJobsController::class, 'applied'])->name('appliedJobs')->middleware('verified');

Route::post('/dashboard/jobs/student/applied/delete', [App\Http\Controllers\studentJobsController::class, 'appliedelete'])->name('deleteappliedJob')->middleware('verified');

Route::get('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('verified');

Route::post('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile')->middleware('verified');

Route::get('/dashboard/jobs/applied/view', [App\Http\Controllers\jobsController::class, 'appliedview'])->name('appliedCheckJob')->middleware('verified');

Route::post('/dashboard/jobs/applied/change/status', [App\Http\Controllers\jobsController::class, 'statuschange'])->name('statuschangeJob')->middleware('verified');

Route::get('/dashboard/jobs/applied/waitlisted', [App\Http\Controllers\jobsController::class, 'waitlistedview'])->name('waitlistedJob')->middleware('verified');

Route::get('/dashboard/jobs/applied/approved', [App\Http\Controllers\jobsController::class, 'approvedview'])->name('approvedJob')->middleware('verified');

Route::get('/dashboard/jobs/applied/rejected', [App\Http\Controllers\jobsController::class, 'rejectedview'])->name('rejectedJob')->middleware('verified');

Route::get('/dashboard/jobs/applied/reviewing', [App\Http\Controllers\jobsController::class, 'reviewingview'])->name('reviewingJob')->middleware('verified');

