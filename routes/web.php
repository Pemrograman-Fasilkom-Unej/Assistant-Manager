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

Route::post('/AKn3hd29JF2/webhook', \App\Http\Controllers\Telegram\MainController::class)->name('telegram.webhook');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/redirect', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin.overview');
        } else {
            return redirect()->route('dashboard.student.overview');
        }
    })->name('redirector');


    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ], function () {
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

            Route::get('/assignment', [\App\Http\Controllers\Admin\AssignmentController::class, 'index'])->name('assignment.index');
            Route::get('/assignment/create', [\App\Http\Controllers\Admin\AssignmentController::class, 'create'])->name('assignment.create');
            Route::post('/assignment', \App\Actions\Academic\CreateAssignment::class)->name('assignment.store');

            Route::get('/student', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('student.index');

            Route::get('/links', [\App\Http\Controllers\Admin\LinkController::class, 'index'])->name('link.index');
            Route::get('/setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
        });

        // Dashboard Assistant Controller
        Route::group([
            'middleware' => ['role:assistant'],
            'prefix' => 'assistant',
            'as' => 'assistant.'
        ], function () {
            Route::get('/', AssistantDashboardController::class)->name('overview');

            Route::post('/assignment', [\App\Http\Controllers\Admin\AssignmentController::class, 'store'])->name('assignment.store');
        });

        // Dashboard Student Controller
        Route::group([
            'middleware' => ['role:student'],
            'prefix' => 'student',
            'as' => 'student.'
        ], function () {
            Route::get('/', StudentDashboardController::class)->name('overview');

            Route::post('/assignment/{assignment:token}/submit', [\App\Http\Controllers\Admin\AssignmentController::class, 'store'])->name('assignment.submit');
        });

    });

    Route::group([
        'prefix' => 'api',
        'as' => 'api.'
    ], function () {

    });
});

Route::get('/test', function () {
    return \App\Repositories\AssignmentRepository::getAssistantAssignments()->forPage(1,1);
    return \Telegram\Bot\Laravel\Facades\Telegram::getMe();
    return \App\Models\Classroom::whereHas('assistants', function($q){
        $q->where('assistant_id', 463);
    })->get();
//    dd(\Illuminate\Support\Facades\Storage::cloud());
    return \Illuminate\Support\Facades\Storage::disk('minio')->put('/test.txt', 'Hello cok');
    dd(\Illuminate\Support\Facades\Storage::disk('minio')->put('/test.txt', 'Hello cok'));
    return \App\Repositories\Shortlink::getLinks();
    $files = \Illuminate\Support\Facades\Storage::disk('database')->allFiles();
    $students = [];
    foreach ($files as $file) {
        $batch = \Illuminate\Support\Facades\Storage::disk('database')->get($file);
        $datas = \Illuminate\Support\Str::of($batch)->explode("\n");
        unset($datas[count($datas) - 1]);
        foreach ($datas as $data) {
            $d = explode(",", $data);
            array_push($students, [
                'username' => $d[0],
                'name' => $d[1]
            ]);
        }
    }
    dd($students);
});

// Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
