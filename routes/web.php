<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

//----------------------------------------- Front -----------------------------------------
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('/welcome', 'HomeController@index')->name('welcome');
Route::get('/contact', 'HomeController@contact')->name('contact');
//room
// Route::get('/showDetail/{name}/{id}', 'HomeController@showDetail');
Route::get('/showDetail/{name}/{id}', ['as' => 'home.showDetail', 'uses' => 'HomeController@showDetail']);

//booking
Route::get('/book', 'front\BooksController@index')->name('book');
Route::post('/book/page_data', 'front\BooksController@page_data')->name('book.page_data');
Route::post('/book/page_info', 'front\BooksController@page_info')->name('book.page_info');
Route::post('/book/page_confirm', 'front\BooksController@page_confirm')->name('book.page_confirm');
Route::post('/book/permitPDF', 'front\BooksController@pdf')->name('book.permitPDF');
Route::post('/book/update', 'front\BooksController@update')->name('book.update');
Route::post('/book/cancel', 'front\BooksController@cancel')->name('book.cancel');

//history booking
Route::get('/history', 'front\HistoryBookController@index')->name('history');
Route::post('/history/update', 'front\HistoryBookController@showUpdate')->name('history.display.update');

//assessment
Route::get('/assessment', 'front\AssessmentController@index')->name('assessment');
Route::get('/assessment/question/{assessment_form_id}/{classrooms}/{numbers}', 'front\AssessmentController@question');
Route::post('/assessment/store', 'front\AssessmentController@assessment')->name('assessment.store');

//----------------------------------------- Admin -----------------------------------------
Route::get('/Admin-Dashboard', 'admin\HistoryBookController@index')->name('dashboard');
Route::post('/mark-as-read', 'admin\HistoryBookController@markNotification')->name('admin.markNotification');

//history booking
Route::post('/Admin-Update', 'admin\HistoryBookController@showUpdate')->name('admin.history.display.update');
Route::post('/Admin-Approve', 'admin\HistoryBookController@approve')->name('admin.history.approve');
Route::get('/history/{id}', ['as' => 'admin.history.showHistory', 'uses' => 'admin\HistoryBookController@showHistory']);

//semesters
Route::get('semesters', 'admin\SemestersController@index')->name('semesters');
Route::post('semesters/fetch_data/', 'admin\SemestersController@fetch_data')->name('semesters.fetch_data');
Route::post('semesters/pagination_link', 'admin\SemestersController@pagination_link')->name('semesters.pagination_link');
Route::post('semesters', 'admin\SemestersController@store')->name('semesters.store');
Route::post('semesters/update', 'admin\SemestersController@update')->name('semesters.update');
Route::post('semesters/semesters_del', 'admin\SemestersController@semesters_del')->name('semesters.semesters_del');
Route::post('semesters/semesters_status', 'admin\SemestersController@semesters_status')->name('semesters.semesters_status');

//classrooms
Route::get('classrooms', 'admin\ClassRoomsController@index')->name('classrooms');
Route::post('classrooms/fetch_data/', 'admin\ClassRoomsController@fetch_data')->name('classrooms.fetch_data');
Route::post('classrooms/pagination_link', 'admin\ClassRoomsController@pagination_link')->name('classrooms.pagination_link');
Route::post('classrooms', 'admin\ClassRoomsController@store')->name('classrooms.store');
Route::post('classrooms/update', 'admin\ClassRoomsController@update')->name('classrooms.update');
Route::post('classrooms/classrooms_del', 'admin\ClassRoomsController@classrooms_del')->name('classrooms.classrooms_del');
Route::post('classrooms/classrooms_status', 'admin\ClassRoomsController@classrooms_status')->name('classrooms.classrooms_status');

Route::get('/classrooms/addSupport/{name}/{id}', 'admin\ClassRoomsController@addSupport');
Route::post('classrooms/addSupport', 'admin\ClassRoomsController@storeAddSupport')->name('addSupport.store');

Route::get('/classrooms/addSoftwares/{name}/{id}', 'admin\ClassRoomsController@addSoftwares');
Route::post('classrooms/addSoftwares', 'admin\ClassRoomsController@storeAddSoftwares')->name('addSoftwares.store');

Route::get('/classrooms/addImage/{name}/{id}/{numbers}', 'admin\ClassRoomsController@addImage');
Route::post('classrooms/addImage', 'admin\ClassRoomsController@storeAddImage')->name('addImage.store');
Route::post('classrooms/addPreview', 'admin\ClassRoomsController@updatePreview')->name('addImage.preview');
Route::post('classrooms/delImage', 'admin\ClassRoomsController@delImage')->name('addImage.delImg');

//classrooms_support
Route::get('classrooms_support', 'admin\ClassRoomsSupportController@index')->name('classrooms_support');
Route::post('classrooms_support/fetch_data/', 'admin\ClassRoomsSupportController@fetch_data')->name('classrooms_support.fetch_data');
Route::post('classrooms_support/pagination_link', 'admin\ClassRoomsSupportController@pagination_link')->name('classrooms_support.pagination_link');
Route::post('classrooms_support', 'admin\ClassRoomsSupportController@store')->name('classrooms_support.store');
Route::post('classrooms_support/update', 'admin\ClassRoomsSupportController@update')->name('classrooms_support.update');
Route::post('classrooms_support/classrooms_support_del', 'admin\ClassRoomsSupportController@classrooms_support_del')->name('classrooms_support.classrooms_support_del');

//softwares
Route::get('softwares', 'admin\SortwaresController@index')->name('softwares');
Route::post('softwares/fetch_data/', 'admin\SortwaresController@fetch_data')->name('softwares.fetch_data');
Route::post('softwares/pagination_link', 'admin\SortwaresController@pagination_link')->name('softwares.pagination_link');
Route::post('softwares', 'admin\SortwaresController@store')->name('softwares.store');
Route::post('softwares/update', 'admin\SortwaresController@update')->name('softwares.update');
Route::post('softwares/softwares_del', 'admin\SortwaresController@softwares_del')->name('softwares.softwares_del');

//assessment
Route::get('assessmentForm', 'admin\AssessmentFormController@index')->name('assessmentForm');

//question
Route::get('/question/{semesters_id}/{classrooms_id}', 'admin\QuestionController@index');
Route::post('question', 'admin\QuestionController@store')->name('question.store');
Route::post('question/update', 'admin\QuestionController@update')->name('question.update');
Route::post('question/del', 'admin\QuestionController@del')->name('question.del');

//question prototype
Route::get('/question/prototype', 'admin\QuestionPrototypeController@index')->name('question.prototype');
Route::post('question/prototype', 'admin\QuestionPrototypeController@store')->name('question.prototype.store');
Route::post('question/prototype/update', 'admin\QuestionPrototypeController@update')->name('question.prototype.update');
Route::post('question/prototype/del', 'admin\QuestionPrototypeController@del')->name('question.prototype.del');
Route::post('question/prototype/setQuestion', 'admin\QuestionPrototypeController@setQuestion')->name('question.prototype.setQuestion');

//report
Route::get('/report/classroom', 'admin\ReportClassRoomController@index')->name('report.classroom');
Route::post('/report/classroom/report', 'admin\ReportClassRoomController@report')->name('report.classroom.report');
Route::post('/report/classroom/report/pdf', 'admin\ReportClassRoomController@pdf')->name('report.classroom.report.pdf');


Route::get('/report/assessment', 'admin\ReportAssessmentController@index')->name('report.assessment');
Route::post('/report/assessment/report', 'admin\ReportAssessmentController@report')->name('report.assessment.report');
Route::post('/report/assessment/report/pdf', 'admin\ReportAssessmentController@pdf')->name('report.assessment.report.pdf');

//clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return view('site.front.index');
});

