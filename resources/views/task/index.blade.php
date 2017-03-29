@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex">
                        <div style="flex-basis: 10%">
                            <a class="btn btn-primary btn-block" href="/tasks/create">Create task</a>
                        </div>
                        <p style="flex-basis: 90%;padding-top: 5px">
                        </p>

                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Assigned To</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td><a href="/tasks/{{$task->id}}">{{$task->name}}</a></td>
                                    <td>
                                        @foreach($task->users()->get() as $user)
                                            {{$user->name}},
                                        @endforeach
                                    </td>
                                    <td>{{$task->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection