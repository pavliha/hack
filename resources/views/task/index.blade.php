@extends('layouts.app')
@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header" style="display: flex">
                        <div>
                            @if(auth()->user()->hasRole("admin"))
                                <a class="btn btn-primary btn-block" href="/tasks/create">Create task</a>
                            @else
                                <span>Task list</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-block">
                        <div v-for="task in tasks" class="task">
                          <div class="row no-gutters">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" v-model="task.done">
                              <span class="custom-control-indicator"></span>
                            </label>
                            <div class="col-sm task-text" @click="onClick()">
                              <span>@{{ task.name }}</span>
                            </div>
                            <div class="col-sm-12 task-body task-footer">
                              <span>Создано: 8 Март 2017.</span>
                              <button class="action" data-toggle="modal" data-target="#exampleModal">Назначено: Вам и еще 4.</button>
                              <span>Редактровать</span>
                            </div>
                          </div>
                        </div>
                        
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Assigned To</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in tasks">
                                    <td><a href="@{{ task.id }}">@{{ task.name }}</a></td>
                                    <td>
                                        <input type="text"
                                               class="form-control"
                                               data-task="@{{ task.id }}"
                                               id="tokenfield"
                                               placeholder="Choose name and hit enter"/>
                                    </td>
                                    <td>@{{ task.updated_at }}</td>
                                    <td>
                                        <a href="/tasks/@{{ task.id }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('remove-form').submit();">
                                            <i class="fa fa-close"></i>
                                        </a>

                                        <form id="remove-form" action="/tasks/@{{ task.id }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field("DELETE") }}
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>
    <script>
        var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            tasks: []
          },
          created: function () {
            var self = this;
            axios.get('/api/tasks').then(function (response) {
                self.tasks = response.data;
            });
          }
        })
    </script>
    <!--script>
        $.get("/api/users",data =>{
            $('#tokenfield').on('tokenfield:createtoken',(e) => {

                $.post("/api/task/assign", {
                    task: e.target.dataset.task,
                    user: e.attrs.value,
                    _token: Laravel.csrfToken
                }).done(() => {
                });

            }).tokenfield({
                autocomplete: {
                    source: data.map(obj => obj.name),
                    delay: 0
                },
                showAutocompleteOnFocus: true
            });
        });

        // $("#alert-success").hide();
        $("#user-option").on("change", e => {

        })

    </script-->
@endsection