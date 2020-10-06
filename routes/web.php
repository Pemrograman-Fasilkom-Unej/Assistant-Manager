<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Assistant\DashboardController as AssistantDashboardController;
use App\Http\Controllers\Assistant\DashboardController as StudentDashboardController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/redirect', function(){
        $user = \Illuminate\Support\Facades\Auth::user();
        if($user->hasRole('admin')){
            return redirect()->route('dashboard.admin.overview');
        } else {
            return redirect()->route('dashboard.student.overview');
        }
    })->name('redirector');


    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ], function(){
        // Dashboard Admin Controller
        Route::group([
            'middleware' => ['role:admin'],
            'prefix' => 'admin',
            'as' => 'admin.'
        ], function () {
            Route::get('/', AdminDashboardController::class)->name('overview');
            Route::get('/assistant', [\App\Http\Controllers\Admin\AssistantController::class, 'index'])->name('assistant.index');
            Route::get('/assistant/create', [\App\Http\Controllers\Admin\AssistantController::class, 'create'])->name('assistant.create');

            Route::get('/classroom', [\App\Http\Controllers\Admin\ClassroomController::class, 'index'])->name('classroom.index');
            Route::get('/classroom/create', [\App\Http\Controllers\Admin\ClassroomController::class, 'create'])->name('classroom.create');
        });

        // Dashboard Assistant Controller
        Route::group([
            'middleware' => ['role:assistant'],
            'prefix' => 'assistant',
            'as' => 'assistant.'
        ], function () {
            Route::get('/', AssistantDashboardController::class)->name('overview');
        });

        // Dashboard Student Controller
        Route::group([
            'middleware' => ['role:student'],
            'prefix' => 'student',
            'as' => 'student.'
        ], function () {
            Route::get('/', StudentDashboardController::class)->name('overview');
        });

    });

    Route::group([
        'prefix' => 'api',
        'as' => 'api.'
    ], function(){

    });
});

// Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
