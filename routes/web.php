<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    if(Auth::user()->is('admin')){
        return redirect('/admin/dashboard');
    } else {
        return "Not yet";
    }
})->middleware('auth');

Auth::routes();

Route::group(['prefix' => 'ajax', 'as' => 'ajax.', 'namespace' => 'Ajax'], function(){
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function(){
        Route::get('assistants', 'AdminController@getAssistants')->name('assistant.index');
        Route::get('classes', 'AdminController@getClasses')->name('class.index');
        Route::get('classes/{class}', 'AdminController@getClassDetail')->name('class.detail');
        Route::get('tasks', 'AdminController@getTasks')->name('task.index');
        Route::get('tickets', 'AdminController@getTickets')->name('ticket.index');
        Route::get('task/student/info/{id}', 'AdminController@getStudentInfo')->name('student.info');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function(){
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/class', 'ClassController');
    Route::get('/class/{class}/{student}', 'ClassController@detailStudent')->name('class.student.detail');
    Route::resource('/assistant', 'AssistantController');
    Route::resource('/task', 'TaskController')->except(['create', 'store']);
    Route::get('/task/create/{class}', 'TaskController@create')
        ->middleware('can:view,class')
        ->name('task.create');
    Route::post('/task/store/{class}', 'TaskController@store')
        ->middleware('can:view,class')
        ->name('task.store');
    Route::post('/task/{task}/score/store', 'TaskController@storeScore')
        ->middleware('can:view,task')
        ->name('task.score.store');
    Route::resource('/ticket', 'TicketController');
    Route::resource('/calendar', 'CalendarController');
});

Route::get('/task/{token}', 'TaskController@show')->name('task.show');
Route::post('/task/{token}', 'TaskController@uploadSubmission')->name('task.upload');
Route::post('/task/{token}/check', 'TaskController@checkStudent')->name('task.check');


Route::get('test', function (){
    $task = \App\Task::first();
    return $task->file_type_format;
});