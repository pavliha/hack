@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex">
                        <p style="flex-basis: 90%;padding-top: 5px">
                            {{$task->name}}
                        </p>
                        <div style="flex-basis: 10%">
                            @if(auth()->user()->hasRole("admin"))
                                <a class="btn btn-primary btn-block" href="/tasks/{{$task->id}}/edit">Edit</a>
                            @endif

                        </div>
                    </div>

                    <div class="panel-body">
                        {{$task->description}}
                    </div>
                    <div class="panel-footer">
                        Assigned to users:
                        @foreach($task->users()->get() as $user)
                            {{$user->name}},
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection