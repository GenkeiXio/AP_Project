<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;

/*
|--------------------------------------------------------------------------
| Home / Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Student Auth
|--------------------------------------------------------------------------
*/
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Student Dashboard (session-based)
Route::middleware(\App\Http\Middleware\StudentAuth::class)->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/student/avatar',   [StudentDashboardController::class, 'saveAvatar'])->name('student.avatar');
});

/*
|--------------------------------------------------------------------------
| Staff Auth (Admin + Teacher) - AJAX
|--------------------------------------------------------------------------
*/
Route::post('/staff/verify-credentials', [StaffAuthController::class, 'verifyCredentials'])->name('staff.verify-credentials');
Route::post('/staff/verify-access-code', [StaffAuthController::class, 'verifyAccessCode'])->name('staff.verify-access-code');
Route::post('/staff/clear-pending', [StaffAuthController::class, 'clearPending'])->name('staff.clear-pending');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/create-teacher', [AdminDashboardController::class, 'createTeacher'])->name('create-teacher');
    Route::post('/create-admin', [AdminDashboardController::class, 'createAdmin'])->name('create-admin');
    Route::get('/teachers', [AdminDashboardController::class, 'getTeachers'])->name('teachers');
    Route::patch('/teacher/{teacher}/toggle', [AdminDashboardController::class, 'toggleTeacher'])->name('teacher.toggle');
    Route::post('/logout', [StaffAuthController::class, 'logoutAdmin'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [StaffAuthController::class, 'logoutTeacher'])->name('logout');
});
