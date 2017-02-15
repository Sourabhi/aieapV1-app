<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('about_aieap', function () {
    return view('aieap.about_aieap');
});

Route::get('facilities', function () {
    return view('aieap.facilities');
});

Route::get('academic_english', function () {
    return view('aieap.academic_english');
});

Route::get('beginners', function () {
    return view('aieap.beginners');
});

Route::get('general_english', function () {
    return view('aieap.general_english');
});

Route::get('high_school', function () {
    return view('aieap.high_school');
});

Route::get('junior', function () {
    return view('aieap.junior');
});
Route::get('professional', function () {
    return view('aieap.professional');
});
Route::get('pronunciation_fluency', function () {
    return view('aieap.pronunciation_fluency');
});
Route::get('ielts', function () {
    return view('aieap.ielts');
});

Route::get('conditions', function () {
    return view('aieap.conditions');
});
Route::get('enrolment_process', function () {
    return view('aieap.enrolment_process');
});

Route::get('refund_cancellation', function () {
    return view('aieap.refund_cancellation');
});

Route::get('courses_fees', function () {
    return view('aieap.courses_fees');
});

Route::get('contact_us', function () {
    return view('aieap.contact_us');
});

Route::get('enrolment_form', function () {
    return view('aieap.enrolment_form');
});
Route::get('staff_teachers', function () {
    return view('aieap.staff_teachers');
});
Route::get('representatives', function () {
    return view('aieap.representatives');
});
Route::get('travel_trans_acco', function () {
    return view('aieap.travel_trans_acco');
});
Route::get('visa', function () {
    return view('aieap.visa');
});
Route::get('welfare', function () {
    return view('aieap.welfare');
});

Route::get('register_success', function () {
    return view('register_success');
});

 
Route::get('visitor', 'VisitorQueryController@index');
Route::get('visitor/{id}', 'VisitorQueryController@show');
Route::get ('contact_us','VisitorQueryController@create');
Route::post('contact_us','VisitorQueryController@store');
Route::get('edit/query/{id}', 'VisitorQueryController@edit');
Route::put('edit/query/{id}', 'VisitorQueryController@update');
Route::delete('delete/query/{id}','VisitorQueryController@destroy');


Route::get('course',['uses'=>'CoursesController@index',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );
//Route::get('course', 'CoursesController@index');
 Route::get ('create/course','CoursesController@create');
Route::post ('create/course','CoursesController@store');
Route::get('course/{id}', 'CoursesController@show');
Route::get('edit/course_day/{id}', 'CoursesController@edit');
Route::put('edit/course_day/{id}', 'CoursesController@update');
Route::delete('delete/course_day/{id}','CoursesController@destroy');

Route::get('student_dash', 'StudentsController@index');
Route::get('enrolment_form','StudentsController@create');
Route::post('enrolment_form','StudentsController@store');
Route::get('student/{id}', 'StudentsController@show');
Route::get('edit/student/{id}', 'StudentsController@edit');
Route::put('edit/student/{id}', 'StudentsController@update');
Route::delete('delete/student/{id}', 'StudentsController@destroy');



Route::get('user_info',['uses'=>'UsersController@index',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );

//Route::get('user_info','UsersController@index');
Route::get('create/register','UsersController@create');
Route::post('create/register','UsersController@store');
Route::get('user/{id}', 'UsersController@show');  

Route::get('register_confirm', 'RegisterSuccessController@index');
Route::get('enrolment_confirm', 'EnrolmentSubmitController@index');
Route::get('query_confirm', 'VisitorQuerySubmitController@index');
//Route::auth();
 Route::get('/home', 'HomeController@index');

$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');

// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');


Route::get('role',['uses'=>'RolesController@index',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );

Route::get('create/role', ['uses'=>'RolesController@create',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );

Route::post('create/role', ['uses'=>'RolesController@store',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );


/*Route::get('role', 'RolesController@index');
Route::get('create/role','RolesController@create');
Route::post('create/role','RolesController@store');*/
Route::get('role/{id}', 'RolesController@show');

Route::get('edit/role/{id}', 'RolesController@edit');
Route::put('edit/role/{id}', 'RolesController@update');
Route::delete('delete/role/{id}', 'RolesController@destroy');


Route::get('admin_dash',['uses'=>'AdminController@index',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );

Route::get('admin/user/{id}', ['uses'=>'AdminController@edit',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']]);

Route::put('admin/user/{id}', ['uses'=>'AdminController@update',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']]);

/*Route::post('create/enrolment',['uses'=>'AdminController@store',
    'as'=>'role',
    'middleware'=>'roles',
    'roles'=>['Admin']
    ] );*/
//Route::get('create/enrolment','AdminController@create');
//Route::post('create/enrolment','AdminController@store');
//Route::get('enrolment/{id}', 'AdminController@show');
//Route::get('edit/enrolment/{id}', 'AdminController@edit');
//Route::put('edit/enrolment/{id}', 'AdminController@update');
//Route::delete('delete/enrolment/{id}', 'AdminController@destroy');

//Route::get('dashboard1', 'StudentDashController@index');

Route::get('timeslot', 'TimeSlotsController@index');
Route::get ('create/timeslot','TimeSlotsController@create');
Route::post('create/timeslot','TimeSlotsController@store');
Route::get('timeslot/{id}', 'TimeSlotsController@show');
Route::get('edit/timeslot/{id}', 'TimeSlotsController@edit');
Route::put('edit/timeslot/{id}', 'TimeSlotsController@update');
Route::delete('delete/timeslot/{id}','TimeSlotsController@destroy');

Route::get('day', 'DaysController@index');
Route::get ('create/day','DaysController@create');
Route::post('create/day','DaysController@store');
Route::get('edit/day/{id}', 'DaysController@edit');
Route::get('day/{id}', 'DaysController@show');
Route::put('edit/day/{id}', 'DaysController@update');
Route::delete('delete/day/{id}','DaysController@destroy');

//Image Route
Route::get('image/delete/{id}','StudentsController@getImage');
Route::delete('image/delete/{id}','StudentsController@deleteImage');

 Route::get('index', function () {
    return view('aieap.index');
    }); 
    
/*Route::group(['middleware'=>'roles:admin'],function(){

  
});





