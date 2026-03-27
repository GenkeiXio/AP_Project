<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAnalyticsController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Teacher\TeacherAnalyticsController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentClassController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', fn() => view('home'))->name('home');

Route::post('/student/login',  [StudentAuthController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::middleware(\App\Http\Middleware\StudentAuth::class)->group(function () {
    Route::get('/student/dashboard',         [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/select-character',  [StudentController::class, 'selectCharacter'])->name('student.select-character');
    Route::post('/student/save-character',   [StudentController::class, 'saveCharacter'])->name('student.save-character');
    Route::get('/student/profile',           [StudentController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile/avatar',   [StudentController::class, 'updateAvatar'])->name('student.profile.avatar');
    Route::post('/student/profile/username', [StudentController::class, 'updateUsername'])->name('student.profile.username');
    Route::post('/student/avatar',           [StudentClassController::class, 'saveAvatar'])->name('student.avatar');
    Route::get('/student/classes',                  [StudentClassController::class, 'index'])->name('student.classes');
    Route::get('/student/classes/search',           [StudentClassController::class, 'search'])->name('student.classes.search');
    Route::post('/student/classes/join',            [StudentClassController::class, 'join'])->name('student.classes.join');
    Route::delete('/student/classes/{class}/leave', [StudentClassController::class, 'leave'])->name('student.classes.leave');
    Route::get('/student/classes/{class}',          [StudentClassController::class, 'classDetail'])->name('student.class.detail');
    Route::get('/student/quiz/{quiz}/play',         [StudentClassController::class, 'playQuiz'])->name('student.quiz.play');
    Route::post('/student/quiz/{quiz}/submit',      [StudentClassController::class, 'submitQuiz'])->name('student.quiz.submit');
});

Route::post('/staff/verify-credentials', [StaffAuthController::class, 'verifyCredentials'])->name('staff.verify-credentials');
Route::post('/staff/verify-access-code', [StaffAuthController::class, 'verifyAccessCode'])->name('staff.verify-access-code');
Route::post('/staff/clear-pending',      [StaffAuthController::class, 'clearPending'])->name('staff.clear-pending');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                  [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/create-teacher',            [AdminDashboardController::class, 'createTeacher'])->name('create-teacher');
    Route::post('/create-admin',              [AdminDashboardController::class, 'createAdmin'])->name('create-admin');
    Route::get('/teachers',                   [AdminDashboardController::class, 'getTeachers'])->name('teachers');
    Route::patch('/teacher/{teacher}/toggle', [AdminDashboardController::class, 'toggleTeacher'])->name('teacher.toggle');
    Route::get('/analytics',                  [AdminAnalyticsController::class, 'index'])->name('analytics');
    Route::get('/analytics/export',           [AdminAnalyticsController::class, 'export'])->name('analytics.export');
    Route::post('/logout',                    [StaffAuthController::class, 'logoutAdmin'])->name('logout');
});

Route::middleware('auth:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard',                              [TeacherDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile',                                [TeacherProfileController::class, 'index'])->name('profile');
    Route::post('/profile/info',                          [TeacherProfileController::class, 'updateInfo'])->name('profile.info');
    Route::post('/profile/avatar',                        [TeacherProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/profile/password',                      [TeacherProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/classes',                                [ClassController::class, 'index'])->name('classes');
    Route::post('/classes',                               [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{class}',                        [ClassController::class, 'show'])->name('classes.show');
    Route::put('/classes/{class}',                        [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{class}',                     [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::delete('/classes/{class}/students/{student}',  [ClassController::class, 'removeStudent'])->name('classes.remove-student');
    Route::post('/classes/{class}/regenerate-code',       [ClassController::class, 'regenerateCode'])->name('classes.regenerate-code');
    Route::get('/classes/{class}/quizzes/create',         [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/classes/{class}/quizzes',               [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}/edit',                    [QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{quiz}',                         [QuizController::class, 'update'])->name('quizzes.update');
    Route::patch('/quizzes/{quiz}/publish',               [QuizController::class, 'togglePublish'])->name('quizzes.publish');
    Route::delete('/quizzes/{quiz}',                      [QuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::get('/analytics',                              [TeacherAnalyticsController::class, 'index'])->name('analytics');
    Route::get('/analytics/export',                       [TeacherAnalyticsController::class, 'export'])->name('analytics.export');
    Route::post('/logout',                                [StaffAuthController::class, 'logoutTeacher'])->name('logout');
});

Route::get('/narration', function () {
    return view('narration');
})->name('narration');

Route::get('/module', function () {
    return view('Students.module');
})->name('module.home');



Route::get('/pre-test/module-2', function () {
    return view('Students.Pre-Test.module2');
})->name('pretest.module2');

Route::get('/node-3', function () {
    return view('Students.Pre-Test.Nodes.node3');
})->name('node3');

Route::get('/node-1/solid-waste', function () {
    return view('Students.Pre-Test.Node1_Solid Waste_Overview');
})->name('node1.solid-waste');

Route::get('/node-1/solid-waste/activity', function () {
    return view('Students.Pre-Test.Node1_Solid Waste');
})->name('node1.solid-waste.activity');

Route::get('/demo-map', function () {
    return view('Students.Games.mainmap');
})->name('student.map');

Route::get('/node2', function () {
    return view('Students.Pre-Test.Nodes.node2');
})->name('node2');

Route::get('/node2/activity', function () {
    return view('Students.Pre-Test.Nodes.node2_activity');
})->name('node2.activity');
