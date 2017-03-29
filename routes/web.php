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

use App\Task;
use App\User;
use Illuminate\Http\Request;

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return redirect("/tasks");
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource("/tasks", "TaskController");


Route::resource("/api/tasks", "TaskApiController");

Route::resource("/api/users", "UsersApiController");

Route::post("/api/task/assign", function (Request $request) {
    $task = Task::find($request->task);

    if (is_numeric($request->user)) {
        $task->users()->detach($request->user);
    }else{
        $user = User::where("name" ,$request->user)->get()[0];
        $task->users()->attach($user->id);
    }
});

Route::post("/api/task/detach", function (Request $request) {
    $task = Task::find($request->task);

    if (is_numeric($request->user)) {
        $task->users()->detach($request->user);
    }else{
        $user = User::where("name" ,$request->user)->get()[0];
        $task->users()->detach($user->id);
    }
});