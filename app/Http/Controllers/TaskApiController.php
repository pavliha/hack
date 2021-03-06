<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskApiController extends Controller
{

    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index() {
        return Task::with('users')->get(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function store(CreateTaskRequest $request) {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = 0;
        $task->save();

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        return Task::with('users')->where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return string
     */
    public function update(Request $request, $id) {
        $task = Task::find($id);
        if ($request->has('name')) {
            $task->name = $request->name;
        }
        if ($request->has('completed')) {
            $task->completed = $request->completed;
        }
        if ($request->has('users')) {
            $users_id = [];
            foreach ($request->users as $user) {
                $users_id[] = $user['id'];
            }
            $task->users()->sync($users_id);
        }
        $task->save();
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Task::destroy($id);
        return "success";
    }
}
