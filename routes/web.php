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

Route::redirect('/', '/login');

Route::get('/home', function(){
    if(Auth::user()->is('admin')){
        return redirect('/admin/dashboard');
    } else {
        return redirect('/assistant/dashboard');
    }
})->middleware('auth');

Auth::routes();
Route::redirect('/register', '/');

Route::group(['prefix' => 'ajax', 'as' => 'ajax.', 'namespace' => 'Ajax'], function(){
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function(){
        Route::get('assistants', 'AdminController@getAssistants')->name('assistant.index');
        Route::get('classes', 'AdminController@getClasses')->name('class.index');
        Route::get('classes/{class}', 'AdminController@getClassDetail')->name('class.detail');
        Route::get('tasks', 'AdminController@getTasks')->name('task.index');
        Route::get('tickets', 'AdminController@getTickets')->name('ticket.index');
        Route::get('task/student/info/{id}', 'AdminController@getStudentInfo')->name('student.info');
        Route::post('file/upload', 'AdminController@uploadFile')->name('file.upload');
        Route::get('task/{id}/submissions', 'AdminController@getStudentTaskSubmissions')->name('task.submissions');
    });

    Route::group(['prefix' => 'assistant', 'as' => 'assistant.', 'middleware' => ['auth', 'role:assistant']], function(){
        Route::get('classes', 'AssistantController@getClasses')->name('class.index');
        Route::get('tasks', 'AssistantController@getTasks')->name('task.index');
        Route::get('task/student/info/{id}', 'AssistantController@getStudentInfo')->name('student.info');
        Route::get('task/{id}/submissions', 'AssistantController@getStudentTaskSubmissions')->name('task.submissions');
        Route::get('task/{id}/no-submissions', 'AssistantController@getStudentWithoutTaskSubmissions')->name('task.no_submissions');
    });
});

Route::group(['prefix' => 'assistant', 'namespace' => 'Assistant', 'as' => 'assistant.', 'middleware' => ['auth', 'role:assistant']], function(){
    Route::redirect('/', '/assistant/dashboard')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('/class', 'ClassController')->except([
        'update', 'edit', 'create', 'store'
    ]);
    Route::post('/class/{class}/add-student', 'ClassController@addStudent')->name('class.add-student');
    Route::get('/class/{class}/{student}', 'ClassController@detailStudent')->name('class.student.detail');

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

    Route::get('/link', 'LinkController@index')->name('link.index');
    Route::post('/link', 'LinkController@store')->name('link.store');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');

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
    Route::get('/link', 'LinkController@index')->name('link.index');
    Route::post('/link', 'LinkController@store')->name('link.store');
    Route::delete('/link', 'LinkController@delete')->name('link.delete');

    Route::view('/note', 'coming-soon')->name('note.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/export/class/{id}', 'ExportController@exportClass')->name('class.export');
});

Route::get('/task/{token}', 'TaskController@show')->name('task.show');
Route::post('/task/{token}', 'TaskController@uploadSubmission')->name('task.upload');
Route::post('/task/{token}/check', 'TaskController@checkStudent')->name('task.check');
