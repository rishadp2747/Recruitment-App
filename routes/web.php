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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'add'])->name('addJob');

Route::post('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'addtodb'])->name('addJob');

Route::get('/dashboard/jobs/view', [App\Http\Controllers\jobsController::class, 'view'])->name('viewJob');

Route::get('/dashboard/jobs/update', [App\Http\Controllers\jobsController::class, 'update'])->name('updateJob');

Route::get('/dashboard/jobs/update/{id}', [App\Http\Controllers\jobsController::class, 'updateview']);

Route::post('/dashboard/jobs/update/it', [App\Http\Controllers\jobsController::class, 'updatefromdb'])->name('updateJobDB');

Route::get('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'delete'])->name('deleteJob');

Route::post('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'deletefromdb'])->name('deleteJob');

Route::get('/dashboard/jobs/student/view', [App\Http\Controllers\studentJobsController::class, 'view'])->name('availableJobs');

Route::get('/dashboard/jobs/student/apply/{id}', [App\Http\Controllers\studentJobsController::class, 'applyview']);

Route::get('/dashboard/jobs/student/applied/{id}', [App\Http\Controllers\studentJobsController::class, 'appliedview']);

Route::get('/dashboard/jobs/company/applied/{id}', [App\Http\Controllers\jobsController::class, 'appliedinfo']);

Route::post('/dashboard/jobs/student/apply', [App\Http\Controllers\studentJobsController::class, 'applytodb'])->name('applyJob');

Route::get('/dashboard/jobs/student/applied', [App\Http\Controllers\studentJobsController::class, 'applied'])->name('appliedJobs');

Route::post('/dashboard/jobs/student/applied/delete', [App\Http\Controllers\studentJobsController::class, 'appliedelete'])->name('deleteappliedJob');

Route::get('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::post('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile');

Route::get('/dashboard/jobs/applied/view', [App\Http\Controllers\jobsController::class, 'appliedview'])->name('appliedCheckJob');

Route::post('/dashboard/jobs/applied/change/status', [App\Http\Controllers\jobsController::class, 'statuschange'])->name('statuschangeJob');

Route::get('/dashboard/jobs/applied/waitlisted', [App\Http\Controllers\jobsController::class, 'waitlistedview'])->name('waitlistedJob');

Route::get('/dashboard/jobs/applied/approved', [App\Http\Controllers\jobsController::class, 'approvedview'])->name('approvedJob');

Route::get('/dashboard/jobs/applied/rejected', [App\Http\Controllers\jobsController::class, 'rejectedview'])->name('rejectedJob');

Route::get('/dashboard/jobs/applied/reviewing', [App\Http\Controllers\jobsController::class, 'reviewingview'])->name('reviewingJob');

Route::get('/dashboard/students/delete', [App\Http\Controllers\jobsController::class, 'allowedusersview'])->name('studentdelete');

Route::post('/dashboard/students/delete', [App\Http\Controllers\jobsController::class, 'deleteuserfromdb'])->name('studentdelete');

Route::get('/dashboard/students/add', [App\Http\Controllers\jobsController::class, 'adduserview'])->name('studentadd');

Route::post('/dashboard/students/add', [App\Http\Controllers\jobsController::class, 'addusertodb'])->name('studentadd');