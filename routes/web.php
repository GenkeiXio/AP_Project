<?php

use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\AdminTeacherAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;

/*
|--------------------------------------------------------------------------
| STUDENT LOGIN
|--------------------------------------------------------------------------
*/

Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login');


/*
|--------------------------------------------------------------------------
| ADMIN / TEACHER LOGIN
|--------------------------------------------------------------------------
*/

Route::post('/auth/credentials', [AdminTeacherAuthController::class, 'verifyCredentials']);
Route::post('/auth/access', [AdminTeacherAuthController::class, 'verifyAccessCode']);

/*
|--------------------------------------------------------------------------
| DASHBOARDS
|--------------------------------------------------------------------------
*/

Route::get('student-login', [StudentDashboardController::class, 'index']);
Route::get('student-login', [AdminDashboardController::class, 'index']);
Route::get('student-login', [TeacherDashboardController::class, 'index']);