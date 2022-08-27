<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
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

// Route::get('/', [HomeController::class, 'index']);
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
Route::post('/register', [RegisterController::class, 'registration'])->name('register-user');

Route::middleware(['auth', 'user-access:user'])->group(function () {
   Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.index');
});

Route::get('/logout', [LoginController::class, 'logout']);

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


});

Route::get('/profile', [UserController::class, 'profile'])->name('myprofile');
Route::post('/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
