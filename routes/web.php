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
        Route::post('file/upload', 'AdminController@uploadFile')->name('file.upload');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function(){
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/class', 'ClassController');
    Route::post('/class/enable', 'ClassController@enableClass')->name('class.enable');
    Route::post('/class/disable', 'ClassController@disableClass')->name('class.disable');
    Route::post('/class/{class}/add-student', 'ClassController@addStudent')->name('class.add-student');
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
    Route::get('/task/submission/download/{submission}', 'TaskController@downloadFile')
        ->name('task.submission.download');
    Route::resource('/ticket', 'TicketController');
    Route::resource('/calendar', 'CalendarController');
});

Route::get('/task/{token}', 'TaskController@show')->name('task.show');
Route::post('/task/{token}', 'TaskController@uploadSubmission')->name('task.upload');
Route::post('/task/{token}/check', 'TaskController@checkStudent')->name('task.check');


Route::get('test', function (){
    return \App\AssistantShortlink::storeLink("https://www.youtube.com/watch?v=b54EfRDgWGs", "babi");
    return implode("\n", $c->students->pluck('nim')->toArray());
});