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

Auth::routes();

//将方法写到控制器中，在访问该页面的时候进行登录检查
Route::get('/home', 'HomeController@index')->name('home');

/* 
 * 写法一：
 * Route::post('/projects', 'ProjectsController@store');
 * 这种方式，相当于使用value，但是value会变

 * 写法二:
 * 使用数组，结合uses和as
 * Route::post('/projects', ['uses'=>'ProjectsController@store','as'=>'projects.store']);
 */

//增（create）
Route::post('/projects', 'ProjectsController@store')->name('projects.store');
//这种方式，相当于使用Key，value改变不影响key
//路由名value和实际文件位置无关，可以自己定义

//删（deleteProject）
Route::delete('/projects/{project}', 'ProjectsController@destory')->name('projects.destory');

//改（update）
Route::patch('/projects/{project}','ProjectsController@update')->name('projects.update');

//查（list/show）
Route::get('/', 'ProjectsController@root');
//根路径，返回项目列表
Route::get('/projects/{project}','ProjectsController@show')->name('projects.show');
//查看项目


Route::resource('tasks', 'TasksController');


//定义task完成状态的路由
Route::post('/tasks/check/{id}','TasksController@check')->name('tasks.check');


