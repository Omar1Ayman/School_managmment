<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(["middleware" => "guest"]  , function () {
    Route::get('/', function()
	{
        return view('auth.login');

	});

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth' ]
    ], function(){


        Route::group(["namespace" => "Grades"] , function(){
                Route::resource('grades', "GradeController");
                Route::resource('classes', "RawRoomController");
                Route::post('class', "RawRoomController@class")->name('class');
                Route::get('/Get_teacher/{id}', 'GradeController@Get_teacher');
                Route::get('/Get_teacherSpec/{id}', 'GradeController@Get_teacherSpec');
        });

        Route::group(["namespace" => "Section"] , function(){
            Route::resource('Sections', "SectionController");
        Route::get('/getclasses/{id}', 'SectionController@getclasses');

    });

        // Route::group(["namespace" => "Teacher"] , function(){
        //     Route::resource('Teachers', "TeacherController");

        // });

        //==============================Students============================
         Route::group(["namespace" => "Student"] , function(){
            Route::resource('Students', "StudentController");
            Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::get('open_attachment/{studentsname}/{filename}', 'StudentController@open_attachment')->name('open_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
            #fees invoice
            Route::resource('Fees_Invoices', 'FeesInvoicesController');
            //promotions
            Route::resource('promotion', "PromotionController");
            //Graduated Students
            Route::resource('Graduated', "GraduatedController");
            //Fees
            Route::resource('Fees', "FeesController");
            //RecepitStudent
            Route::resource('receipt_students', 'ReceiptStudentsController');
            //ProcessingFeeController
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            //Payment Students
            Route::resource('Payment_students', 'PaymentController');

            Route::resource('Attendence', 'AttendanceController');

        });
    //==============================Exams============================
    Route::group(['namespace' => 'Exams'], function () {
        Route::resource('Exams', 'ExamController');
    });

    //==============================subjects============================
        Route::group(['namespace' => 'Subjects'], function () {
            Route::resource('subjects', 'SubjectController');
        });

    //==============================Quizzes============================
        Route::group(['namespace' => 'Quizzes'], function () {
            Route::resource('Quizzes', 'QuizzeController');
        });

    //==============================questions============================
        Route::group(['namespace' => 'questions'], function () {
            Route::resource('questions', 'QuestionController');
        });


        Route::view('add-parent', 'livewire.add-form');
        Route::view("add-teacher" , "livewire.add-teacher-form");
        // Route::view('parents', 'livewire.parent_table');



        Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    });











