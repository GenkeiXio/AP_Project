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
use App\Http\Controllers\Student\StudentClassController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\Student\Pretest\Module2PretestController;
use App\Http\Controllers\Student\Module2\Module2_Node1Controller;
use App\Http\Controllers\Student\Module2\Module2_Node2Controller;
use App\Http\Controllers\Student\Module2\Module2_Node3Controller;

Route::get('/', fn() => view('home'))->name('home');

Route::post('/student/login',  [StudentAuthController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::middleware(\App\Http\Middleware\StudentAuth::class)->group(function () {
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

    Route::post('/student/module2/pretest/save', [Module2PretestController::class, 'store']) ->name('student.module2.pretest.save');
    Route::post('/module2/node1/save', [Module2_Node1Controller::class, 'store']) ->name('student.module2.node1.save');
    Route::post('/student/module2/node2/save', [Module2_Node2Controller::class, 'store']) ->name('student.module2.node2.save');
    Route::post('/student/module2/node3/save', [Module2_Node3Controller::class, 'store'] )->name('student.module2.node3.save');
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

Route::get('/node-3/activity', function () {
    return view('Students.Pre-Test.Nodes.node3_activity');
})->name('node3.activity');

Route::get('/node-1/solid-waste', function () {
    return view('Students.Pre-Test.Node1_Solid Waste_Overview');
})->name('node1.solid-waste');

Route::get('/node-1/solid-waste/activity', function () {
    return view('Students.Pre-Test.Node1_Solid Waste');
})->name('node1.solid-waste.activity');


//MAP Routes
Route::get('/demo-map', function () {
    return view('Students.Games.mainmap');
})->name('student.map');

Route::get('/inner-map-2', function () {
    return view('Students.module2.inner_map2'); 
})->name('inner.map2');

Route::get('/node2', function () {
    return view('Students.Pre-Test.Nodes.node2');
})->name('node2');

Route::get('/node2/activity', function () {
    return view('Students.Pre-Test.Nodes.node2_activity');
})->name('node2.activity');

Route::get('/node4', function () {
    return view('Students.Pre-Test.Nodes.node4');
})->name('node4');

Route::get('/module2/final-intro', function () {
    return view('Students.module2.activities.final_activity_intro');
})->name('module2.intro');

Route::get('/module2-activity', function () {
    return view('Students.module2.activities.final_activity');
})->name('module2.activity');

Route::get('/module2-posttest', function () {
    return view('Students.module2.module2_posttest');
})->name('module2.posttest');

Route::get('/module2/essay', function () {
    return view('Students.module2.activities.mod2_essay');
})->name('module2.essay');

Route::post('/module2/essay-submit', [EssayController::class, 'submit'])->name('essay.submit');

Route::get('/module2/buod', function () {
    return view('Students.module2.mod2_buod');
})->name('module2.buod');


//Module 3 Routes//
// MODULE 3 HOME
Route::get('/module3', function () {
    return view('Students.Module3.module3_home');
})->name('module3.home');

// PRETEST
Route::get('/module3/pretest', function () {
    return view('Students.Module3.Test.module3_pretest');
})->name('module3.pretest');

// POSTTEST
Route::get('/module3/posttest', function () {
    return view('Students.Module3.Activities.Test.module3_posttest');
})->name('module3.posttest');

// EXPLORE - SCENE
Route::get('/module3/explore/scene', function () {
    return view('Students.Module3.Activities.Explore.scene');
})->name('module3.scene');

// EXPLORE - BALIK ARAL
Route::get('/module3/balik-aral', function () {
    return view('Students.Module3.Activities.balik-aral');
})->name('module3.balik_aral');

Route::get('/inner-map-3', function () {
    return view('Students.Module3.Inner_map3');
})->name('inner.map3');

Route::get('/module3/node1', function () {
    return view('Students.Module3.Nodes.mod3_node1');
})->name('module3.node1');

Route::get('/module3/node2', function () {
    return view('Students.Module3.Nodes.mod3_node2');
})->name('module3.node2');