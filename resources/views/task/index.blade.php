@extends('layouts.app')
@section("css")
    <link href="/vendor/sliptree-bootstrap-tokenfield-9c06df4/dist/css/bootstrap-tokenfield.css" rel="stylesheet">
    <link href="/vendor/sliptree-bootstrap-tokenfield-9c06df4/dist/css/tokenfield-typeahead.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="alert alert-success" id="alert-success">
                    </div>
                    <div class="panel-heading" style="display: flex">
                        <div style="flex-basis: 10%">
                            @if (Auth::guest())
                                Task list
                            @elseif(auth()->user()->hasRole("admin"))
                                <a class="btn btn-primary btn-block" href="/tasks/create">Create task</a>
                            @endif
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
                                        <input type="text"
                                               class="form-control"
                                               data-task="{{$task->id}}"
                                               id="tokenfield"
                                               placeholder="Choose name and hit enter"/>
                                    </td>
                                    <td>{{$task->updated_at}}</td>
                                    <td>
                                        <a href="/tasks/{{$task->id}}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('remove-form').submit();">
                                            <i class="fa fa-close"></i>
                                        </a>

                                        <form id="remove-form" action="/tasks/{{$task->id}}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                            {{method_field("DELETE")}}
                                        </form>
                                    </td>
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

@section("js")
    <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
            crossorigin="anonymous"></script>
    <script src="/vendor/sliptree-bootstrap-tokenfield-9c06df4/dist/bootstrap-tokenfield.js"></script>
    <script>
        $.get("/api/users",data =>{
            $('#tokenfield').on('tokenfield:createtoken',(e) => {

                $.post("/api/task/assign", {
                    task: e.target.dataset.task,
                    user: e.attrs.value,
                    _token: Laravel.csrfToken
                }).done(() => {
                    $("#alert-success").show().html("Update successful");
                });

            }).tokenfield({
                autocomplete: {
                    source: data.map(obj => obj.name),
                    delay: 0
                },
                showAutocompleteOnFocus: true
            });
        });

        $("#alert-success").hide();
        $("#user-option").on("change", e => {

        })

    </script>
@endsection