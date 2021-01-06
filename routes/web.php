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

Auth::routes(['verify' => false]);

Route::get('/company/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationFormComp']);

Route::post('/company/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerComp'])->name('comp_reg');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('approval');

Route::get('/dashboard/approvalpending', [App\Http\Controllers\HomeController::class, 'approval_checker']);

Route::get('/dashboard/rejected', [App\Http\Controllers\HomeController::class, 'approval_checker']);

Route::get('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'add'])->name('addJob')->middleware('approval');

Route::post('/dashboard/jobs/add', [App\Http\Controllers\jobsController::class, 'addtodb'])->name('addJob')->middleware('approval');

Route::get('/dashboard/jobs/view', [App\Http\Controllers\jobsController::class, 'view'])->name('viewJob')->middleware('approval');

Route::get('/dashboard/jobs/update', [App\Http\Controllers\jobsController::class, 'update'])->name('updateJob')->middleware('approval');

Route::get('/dashboard/jobs/update/{id}', [App\Http\Controllers\jobsController::class, 'updateview'])->middleware('approval');

Route::post('/dashboard/jobs/update/it', [App\Http\Controllers\jobsController::class, 'updatefromdb'])->name('updateJobDB')->middleware('approval');

Route::get('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'delete'])->name('deleteJob')->middleware('approval');

Route::post('/dashboard/jobs/delete', [App\Http\Controllers\jobsController::class, 'deletefromdb'])->name('deleteJob')->middleware('approval');

Route::get('/dashboard/jobs/student/view', [App\Http\Controllers\studentJobsController::class, 'view'])->name('availableJobs')->middleware('approval');

Route::get('/dashboard/jobs/student/apply/{id}', [App\Http\Controllers\studentJobsController::class, 'applyview'])->middleware('approval');

Route::get('/dashboard/jobs/student/applied/{id}', [App\Http\Controllers\studentJobsController::class, 'appliedview'])->middleware('approval');

Route::get('/dashboard/jobs/company/applied/{id}', [App\Http\Controllers\jobsController::class, 'appliedinfo'])->middleware('approval');

Route::post('/dashboard/jobs/student/apply', [App\Http\Controllers\studentJobsController::class, 'applytodb'])->name('applyJob')->middleware('approval');

Route::get('/dashboard/jobs/student/applied', [App\Http\Controllers\studentJobsController::class, 'applied'])->name('appliedJobs')->middleware('approval');

Route::post('/dashboard/jobs/student/applied/delete', [App\Http\Controllers\studentJobsController::class, 'appliedelete'])->name('deleteappliedJob')->middleware('approval');

Route::get('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('approval');

Route::post('/dashboard/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile')->middleware('approval');

Route::get('/dashboard/jobs/applied/view', [App\Http\Controllers\jobsController::class, 'appliedview'])->name('appliedCheckJob')->middleware('approval');

Route::post('/dashboard/jobs/applied/change/status', [App\Http\Controllers\jobsController::class, 'statuschange'])->name('statuschangeJob')->middleware('approval');

Route::post('/dashboard/jobs/applied/change/selection/status', [App\Http\Controllers\jobsController::class, 'statuschangeselected'])->name('statuschangeselectedJob')->middleware('approval');

Route::get('/dashboard/jobs/applied/waitlisted', [App\Http\Controllers\jobsController::class, 'waitlistedview'])->name('waitlistedJob')->middleware('approval');

Route::get('/dashboard/jobs/applied/approved', [App\Http\Controllers\jobsController::class, 'approvedview'])->name('approvedJob')->middleware('approval');

Route::get('/dashboard/jobs/applied/selection', [App\Http\Controllers\jobsController::class, 'selectedview'])->name('selectedJob')->middleware('approval');

Route::get('/dashboard/jobs/applied/rejected', [App\Http\Controllers\jobsController::class, 'rejectedview'])->name('rejectedJob')->middleware('approval');

Route::get('/dashboard/jobs/applied/reviewing', [App\Http\Controllers\jobsController::class, 'reviewingview'])->name('reviewingJob')->middleware('approval');

Route::get('/dashboard/students/delete', [App\Http\Controllers\UsersController::class, 'allowedusersview'])->name('studentdelete')->middleware('approval');

Route::post('/dashboard/students/delete', [App\Http\Controllers\UsersController::class, 'deleteuserfromdb'])->name('studentdelete')->middleware('approval');

Route::get('/dashboard/students/add', [App\Http\Controllers\UsersController::class, 'adduserview'])->name('studentadd')->middleware('approval');

Route::post('/dashboard/students/add', [App\Http\Controllers\UsersController::class, 'addusertodb'])->name('studentadd')->middleware('approval');

Route::get('/dashboard/company/delete', [App\Http\Controllers\UsersController::class, 'allowedcompanyview'])->name('companydelete')->middleware('approval');

Route::post('/dashboard/company/delete', [App\Http\Controllers\UsersController::class, 'deletecompanyfromdb'])->name('companydelete')->middleware('approval');

Route::get('/dashboard/company/approval', [App\Http\Controllers\UsersController::class, 'companyapprovalview'])->name('companyapproval')->middleware('approval');

Route::post('/dashboard/company/approve', [App\Http\Controllers\UsersController::class, 'companyapprove'])->name('companyapprove')->middleware('approval');

Route::post('/dashboard/company/reject', [App\Http\Controllers\UsersController::class, 'companyreject'])->name('companyreject')->middleware('approval');

Route::get('/dashboard/change-password', [App\Http\Controllers\ChangePasswordController::class, 'index'])->name('changepassword');

Route::post('/dashboard/change-password', [App\Http\Controllers\ChangePasswordController::class, 'store'])->name('changepasswordtodb');