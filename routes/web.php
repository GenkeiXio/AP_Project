<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAnalyticsController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Teacher\AnalyticsController;
use App\Http\Controllers\Teacher\ResultsController;
use App\Http\Controllers\Teacher\Module2ResultsController;
use App\Http\Controllers\Student\StudentClassController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\Pretest\Module2PretestController;
use App\Http\Controllers\Student\Module2\Module2_Node1Controller;
use App\Http\Controllers\Student\Module2\Module2_Node2Controller;
use App\Http\Controllers\Student\Module2\Module2_Node3Controller;
use App\Http\Controllers\Student\Module2\Module2_FinalActivityController;
use App\Http\Controllers\Student\Module2\Module2_PosttestController;
use App\Http\Controllers\Student\Module2\Module2_EssayController;
use App\Http\Controllers\Student\Module3\Module3PerformanceTaskController;
use App\Http\Controllers\Student\Module3\Module3_PretestController;
use App\Http\Controllers\Student\Module3\Module3Node1Controller;
use App\Http\Controllers\Student\Module3\Module3Node2Controller;
use App\Http\Controllers\Student\Module3\Module3Node3Controller;
use App\Http\Controllers\Student\Module3\Module3GobagActivityController;
use App\Http\Controllers\Student\Module3\Module3SafeHomeController;
use App\Http\Controllers\Student\Module3\Module3GabayController;
use App\Http\Controllers\Student\Module3\Module3ElninoController;
use App\Http\Controllers\Student\Module3\Module3BulkanController;
use App\Http\Controllers\Student\Module3\Module3FloodController;
use App\Http\Controllers\Student\Module3\Module3PosttestController;
use App\Http\Controllers\Student\Module3\Module3LindolController;
use App\Http\Controllers\Student\Module3\Module3BalikAralController;
use App\Http\Controllers\Student\Module3\Module3ExploreController;
use App\Http\Controllers\Teacher\Module3ResultsController;
use App\Http\Controllers\Student\Module4\Module4HomeController;
use App\Http\Controllers\Student\Module4\Module4PretestController;
use App\Http\Controllers\Student\Module4\Module4BalikAralController;
use App\Http\Controllers\Student\Module4\Module4ExploreController;
use App\Http\Controllers\Student\Module4\Module4GameResultController;
use App\Http\Controllers\Teacher\ModulesController;
use App\Http\Controllers\Teacher\Module4ResultsController;

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
    Route::post('/module2/final-activity/save', [Module2_FinalActivityController::class, 'store']) ->name('student.module2.final.save');
    Route::post('/student/module2/posttest/save', [Module2_PosttestController::class, 'store']) ->name('student.module2.posttest.save');
    Route::post('/student/module2/essay/submit', [Module2_EssayController::class, 'submit']) ->name('student.module2.essay.submit');
    
    Route::get('/student/module3/performance-task', [Module3PerformanceTaskController::class, 'show']) ->name('student.module3.performance-task');
    Route::post('/student/module3/performance-task/save', [Module3PerformanceTaskController::class, 'store']) ->name('student.module3.performance-task.save');
    Route::get('student/module3/pretest', [Module3_PretestController::class, 'index'])->name('student.module3.pretest');
    Route::post('student/module3/pretest/store', [Module3_PretestController::class, 'store'])->name('student.module3.pretest.store');
    Route::get('/module3/node2', [Module3Node2Controller::class, 'index'])->name('module3.node2');
    Route::post('/module3/node2/save', [Module3Node2Controller::class, 'save'])->name('module3.node2.save');
    Route::get('/module3/node1', [Module3Node1Controller::class, 'index'])->name('module3.node1');
    Route::post('/module3/node1/save', [Module3Node1Controller::class, 'save'])->name('module3.node1.save');
    Route::get('/student/module3/node3', [Module3Node3Controller::class, 'index'])->name('student.module3.node3');
    Route::post('/student/module3/node3/save', [Module3Node3Controller::class, 'store'])->name('student.module3.node3.save');
    Route::get('/student/module3/gobag', [Module3GobagActivityController::class, 'index'])->name('student.module3.gobag');
    Route::post('/student/module3/gobag/save', [Module3GobagActivityController::class, 'store'])->name('student.module3.gobag.save');
    Route::get('/student/module3/safe-home', [Module3SafeHomeController::class, 'index'])->name('student.module3.safehome');
    Route::post('/student/module3/safe-home/save', [Module3SafeHomeController::class, 'store'])->name('student.module3.safehome.save');
    Route::get('/student/module3/gabay', [Module3GabayController::class, 'index'])->name('gabay.activity');
    Route::post('/student/module3/gabay/save', [Module3GabayController::class, 'store'])->name('student.module3.gabay.save');
    Route::get('/student/module3/elnino', [Module3ElninoController::class, 'index'])->name('el-nino.activity');
    Route::post('/student/module3/elnino/save', [Module3ElninoController::class, 'store'])->name('student.module3.elnino.save');
    Route::get('/student/module3/bulkan', [Module3BulkanController::class, 'index'])->name('bulkan.activity');
    Route::post('/student/module3/bulkan/save', [Module3BulkanController::class, 'store'])->name('student.module3.bulkan.save');
    Route::get('/student/module3/flood', [Module3FloodController::class, 'index'])->name('flood.activity');
    Route::post('/student/module3/flood/save', [Module3FloodController::class, 'store'])->name('student.module3.flood.save');
    Route::get('/student/module3/posttest', [Module3PosttestController::class, 'index'])->name('student.module3.posttest');
    Route::post('/student/module3/posttest/save', [Module3PosttestController::class, 'store'])->name('student.module3.posttest.save');
    Route::get('/student/module3/lindol', [Module3LindolController::class, 'index'])->name('lindol.activity');
    Route::post('/student/module3/lindol/save', [Module3LindolController::class, 'store'])->name('student.module3.lindol.save');
    Route::post('/student/module3/balik-aral/save', [Module3BalikAralController::class, 'store'])->name('student.module3.balikaral.save');
    Route::post('/student/module3/explore/save', [Module3ExploreController::class, 'store'])->name('student.module3.explore.save');

    Route::post('/student/module4/poll/save', [Module4HomeController::class, 'storePoll'])->name('student.module4.poll.save');
    Route::post('/student/module4/pretest/save', [Module4PretestController::class, 'store'])->name('student.module4.pretest.save');
    Route::post('/student/module4/balik-aral/save', [Module4BalikAralController::class, 'store'])->name('student.module4.balikaral.save');
    Route::post('/student/module4/explore/save', [Module4ExploreController::class, 'store'])->name('student.module4.explore.save');
    Route::post('/student/module4/games/save', [Module4GameResultController::class, 'store'])->name('student.module4.games.save');



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
    Route::get('/analytics',                              [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/analytics/export',                       function () { return "Export CSV";})->name('analytics.export');
    Route::get('/results',                                [ResultsController::class, 'index'])->name('results');
    Route::get('/module2-results',                        [Module2ResultsController::class, 'index'])->name('module2.results');
    Route::get('/module2/student/{id}',                   [Module2ResultsController::class, 'show'])->name('module2.student');
    Route::get('/module2/student/{id}/export',            [Module2ResultsController::class, 'exportFull'])->name('module2.export.full');
    Route::get('/module3/results',                        [Module3ResultsController::class, 'index'])->name('module3.results');
    Route::get('/module3/student/{id}',                   [Module3ResultsController::class, 'show'])->name('module3.student');
    Route::get('/teacher/module3/student/{id}/export',    [Module3ResultsController::class, 'export'])->name('module3.export');
    Route::get('/teacher/modules',                        [ModulesController::class, 'index'])->name('modules');
    Route::get('/module4/results',                        [Module4ResultsController::class, 'index'])->name('module4.results');
    Route::get('/module4/student/{id}',                   [Module4ResultsController::class, 'show'])->name('module4.student');
    Route::get('/module4/student/{id}/export',            [Module4ResultsController::class, 'export'])
    ->name('module4.export');

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

Route::get('/module3-home', function () {
    return redirect()->route('module3.home');
})->name('module3.home.legacy');

Route::get('/module3-pretest', function () {
    return redirect()->route('module3.pretest');
})->name('module3.pretest.legacy');

Route::get('/module3-next', function () {
    return redirect()->route('module3.node2');
})->name('module3.next');

// IV Explore page
Route::get('/students/module-3/iv-explore', function () {
    return redirect()->route('module3.scene');
})->name('module3.iv_explore');

Route::view('/students/module-3/termino-konsepto', 'Students.Module3.termino_konsepto')
    ->name('students.module3.termino_konsepto');

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

Route::get('/module2/buod', function () {
    return view('Students.module2.mod2_buod');
})->name('module2.buod');

/////////////////////
///Module 3 Routes///
/////////////////////

// MODULE 3 HOME
Route::get('/module3', function () {
    return view('Students.Module3.Home');
})->name('module3.home');

// PRETEST
Route::get('/module3/pretest', function () {
    return view('Students.Module3.Test.module3_pretest');
})->name('module3.pretest');

// POSTTEST
Route::get('/module3/posttest', function () {
    return view('Students.Module3.Test.module3_posttest');
})->name('module3.posttest');

// EXPLORE - SCENE
Route::get('/module3/explore/scene', function () {
    return view('Students.Module3.Explore');
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

Route::get('/module3/node3', function () {
    return view('Students.Module3.Nodes.mod3_node3');
})->name('module3.node3');


Route::get('/apply-activity', function () {
    return view('Students.Module3.Activities.apply');
})->name('apply.activity');

Route::get('/gobag-activity', function () {
    return view('Students.Module3.Activities.gobag_activity');
})->name('gobag.activity');

Route::get('/safe-home-activity', function () {
    return view('Students.Module3.Activities.safe_home');
})->name('safehome.activity');

Route::get('/gabay', function () {
    return view('Students.Module3.Activities.gabay');
})->name('gabay.activity');

Route::get('/gabay-page', function () {
    return redirect()->route('gabay.activity');
})->name('gabay.page');

Route::get('/module3/activity/el-nino', function () {
    return view('Students.Module3.Activities.el_niño');
})->name('el-nino.activity');

Route::get('/module3/activity/bulkan', function () {
    return view('Students.Module3.Activities.bulkan');
})->name('bulkan.activity');

Route::get('/module3/activity/flood', function () {

    return view('Students.Module3.Activities.flood_activity');
})->name('flood.activity');

Route::get('/module3/closing', function () {
    return view('Students.Module3.Activities.closing');
})->name('module3.closing');


/////////////////////
///Module 4 Routes///
/////////////////////

Route::view('/module4', 'Students.Module4.Home')->name('module4.home');

Route::get('/module4/pretest', function () {
    return view('Students.Module4.Pretest');
})->name('module4.pretest');

Route::view('/module4/balik-aral', 'Students.Module4.mod4_balikaral')
    ->name('module4.balikaral');

Route::view('/module4/welcome', 'Students.Module4.mod4_welcome')
    ->name('module4.welcome');

Route::view('/module4/explore', 'Students.Module4.mod4_explore')
    ->name('module4.explore');

Route::view('/module4/explore/games/rolly', 'Students.Module4.Explore.Games.rolly_game')
    ->name('module4.rolly.game');

Route::view('/module4/explore/games/baha', 'Students.Module4.Explore.Games.baha_game')
    ->name('module4.baha.game');

Route::view('/module4/explore/games/lindol', 'Students.Module4.Explore.Games.lindol_game')
    ->name('module4.lindol.game');

Route::view('/module4/explore/games/mayon', 'Students.Module4.Explore.Games.mayon_game')
    ->name('module4.mayon.game');

Route::view('/module4/explore/games/landslide', 'Students.Module4.Explore.Games.landslide_game')
    ->name('module4.landslide.game');

Route::view('/module4/alamin', 'Students.Module4.mod4_alamin')
    ->name('module4.alamin');

Route::view('/module4/posttest', 'Students.Module4.mod4_posttest')
    ->name('module4.posttest');

Route::view('/module4/performance', 'Students.Module4.mod4_performance')
    ->name('module4.performance');

Route::view('/module4/buod', 'Students.Module4.mod4_buod')
    ->name('module4.buod');