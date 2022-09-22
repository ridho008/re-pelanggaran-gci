<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypesViolationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
// // Route::get('/', [HomeController::class, 'index'])->middleware('guest');
// // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// // middleware('guest') apakah pengguna telah login ?
// // Route::get('/login', [HomeController::class, 'index'])->name('login');
// Route::get('/login', [HomeController::class, 'index'])->name('login')->middleware('auth');
// Route::get('/logout', [OldHomeController::class, 'logout']);
// Route::post('/authenticate', [HomeController::class, 'authenticate']);
// Route::get('/register', [HomeController::class, 'register']);
// // Route::get('/register', [HomeController::class, 'register'])->middleware('guest');
// Route::post('/registration', [HomeController::class, 'registration']);

Auth::routes();
Route::post('/loginAccount', [LoginController::class, 'myLogin'])->name('loginAccount');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'registration'])->name('register-user');

Route::middleware(['auth', 'user-access:user'])->group(function () {
   Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.index');

   // Report Users
   Route::get('/reports', [ReportController::class, 'indexReportUser'])->name('user.report');
   Route::post('/report/create', [ReportController::class, 'createReport'])->name('user.report.create');
   Route::put('/report/update', [ReportController::class, 'updateReport'])->name('user.report.update');
   Route::get('/report/edit/{id}', [ReportController::class, 'editReport'])->where('id', '[0-9]+')->name('user.report.edit');
   Route::get('/report/getImg/{id}', [ReportController::class, 'getImg'])->where('id', '[0-9]+')->name('user.report.getImg');

   Route::get('/report/detail/{id}', [ReportController::class, 'detailReport'])->where('id', '[0-9]+')->name('user.report.detail');
   Route::post('/report/delete/{id}', [ReportController::class, 'destroyReport'])->where('id', '[0-9]+')->name('user.report.delete');
   
   Route::get('/report/getUserId/{id}', [ReportController::class, 'getUserId'])->where('id', '[0-9]+')->name('user.report.getUserId');
   Route::get('/report/getUserNotifId/{id}', [ReportController::class, 'getReportNotifByUserID'])->where('id', '[0-9]+')->name('user.report.getReportNotifByUserID');

   // Routing Menu Reports
   Route::get('/reports/agree', [ReportController::class, 'agreeReportUser'])->name('reports.agree');
   Route::get('/reports/verification', [ReportController::class, 'verifReportUser'])->name('reports.verification');
   Route::get('/reports/reject', [ReportController::class, 'rejectReportUser'])->name('reports.reject');
});



Route::middleware(['auth', 'user-access:admin'])->group(function () {
   Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.index');

   // ------- Users ------------
   Route::get('/admin/users', [UserController::class, 'index'])->name('users.admin');
   Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
   Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');

   Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
   Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
   Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

   // Report
   Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports.admin');
   Route::get('/admin/create', [ReportController::class, 'create'])->name('admin.report.create');
   Route::post('/admin/report/store', [ReportController::class, 'store'])->where('id', '[0-9]+')->name('admin.report.store');

   Route::get('/admin/report/edit/{id}', [ReportController::class, 'edit'])->where('id', '[0-9]+')->name('admin.report.edit');
   Route::put('/admin/report/update/{id}', [ReportController::class, 'update'])->where('id', '[0-9]+')->name('admin.report.update');

   Route::delete('/admin/report/destroy/{id}', [ReportController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.report.destroy');
   Route::get('/admin/report/detail/{id}', [ReportController::class, 'detail'])->where('id', '[0-9]+')->name('admin.report.detail');

   // Reply Comments
   Route::post('/admin/report/reply/{id}', [ReportController::class, 'replyComment'])->where('id', '[0-9]+')->name('admin.report.comment');

   // Menus Verifikasi
   Route::get('/admin/verif', [ReportController::class, 'verified'])->name('admin.reports.verified');
   Route::put('/admin/report/status/{id}', [ReportController::class, 'status'])->where('id', '[0-9]+')->name('admin.report.status');

   // Halaman Penolakan
   Route::get('/admin/reports/agree', [ReportController::class, 'pageAgree'])->name('admin.report.agree');
   Route::get('/admin/reports/reject', [ReportController::class, 'pageReject'])->name('admin.report.reject');
   Route::get('/admin/reports/verification', [ReportController::class, 'pageVerification'])->name('admin.report.verification');
   // Details Page
   Route::put('/admin/report/detailStatus/{id}', [ReportController::class, 'detailStatus'])->where('id', '[0-9]+')->name('admin.report.detail.status');
   Route::put('/admin/report/buttonAgreeAdmin/{id}', [ReportController::class, 'buttonAgreeAdmin'])->where('id', '[0-9]+')->name('admin.report.detail.buttonAgreeAdmin');

   // Points
   Route::get('/admin/points', [PointController::class, 'index'])->name('points.admin');

   // Types Violations
   Route::get('/admin/typesvio', [TypesViolationsController::class, 'index'])->name('typesVio.admin');
   Route::post('/admin/typesvio/store', [TypesViolationsController::class, 'store'])->name('typesVio.admin.store');
   Route::get('/admin/typesvio/edit/{id}', [TypesViolationsController::class, 'getTypesVByID'])->where('id', '[0-9]+')->name('typesVio.admin.edit');
   Route::put('/admin/typesvio/update', [TypesViolationsController::class, 'update'])->name('typesVio.admin.update');
   Route::delete('/admin/typesvio/destroy/{id}', [TypesViolationsController::class, 'destroy'])->where('id', '[0-9]+')->name('typesVio.admin.destroy');



});

Route::get('/profile', [UserController::class, 'profile'])->name('myprofile');
Route::post('/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
