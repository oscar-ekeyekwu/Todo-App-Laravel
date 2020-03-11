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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects/manage-projects', 'ProjectsController@deptHeadView');


Route::post('/projects/{project}/tasks', 'TasksController@store');
Route::get('/tasks/{task}/remove', 'TasksController@destroy')->name('remove-task');
Route::post('/update', 'TasksController@update');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');


Route::resource('projects', 'ProjectsController');
Route::resource('departments', 'DepartmentsController');
Route::resource('admins', 'AdminController');
Route::resource('projectUser', 'ProjectUsersController');
Route::resource('status', 'StatusController');
Route::resource('tasks', 'TasksController');
Route::resource('user', 'UserController');

Route::view('/admin', '/admin.dashboard');

// Route::group(['middleware' => 'role:admin'], function () {
//     Route::get('/admins', function () {
//         return 'Welcome Admin';
//     });
// });
