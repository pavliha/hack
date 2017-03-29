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
        return Task::all();
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
        return Task::find($id);
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
        $task->name = $request->name;
        $task->description = $request->description;
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
