<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $one = Task::find(1);

        $tasks = Task::paginate(5);

        return view("task.index")
            ->with("users",User::all())
            ->with("tasks",$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("task.create");
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
        return view("task.show")->with("task",Task::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        return view("task.edit")->with("task",Task::find($id));
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
        return redirect("/tasks/$id")->with("status","Update successful");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Task::destroy($id);
        return redirect()->back();
    }
}
