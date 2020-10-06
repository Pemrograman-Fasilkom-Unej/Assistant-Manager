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
            Route::get('/', AdminDashboardController::class);
        });

        // Dashboard Assistant Controller
        Route::group([
            'middleware' => ['role:assistant'],
            'prefix' => 'assistant',
            'as' => 'assistant.'
        ], function () {
            Route::get('/', AssistantDashboardController::class);
        });

        // Dashboard Student Controller
        Route::group([
            'middleware' => ['role:student'],
            'prefix' => 'student',
            'as' => 'student.'
        ], function () {
            Route::get('/', StudentDashboardController::class);
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
