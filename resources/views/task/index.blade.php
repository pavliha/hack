@extends('layouts.app')
@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header" style="display: flex">
                        <div>
                            @if(!auth()->guest())
                                @if(auth()->user()->hasRole("admin"))
                                    <a class="btn btn-primary btn-block" href="/tasks/create">Create task</a>
                                @else
                                    <span>Task list</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-block">
                        <div v-for="task in tasks" class="task">
                            <div class="row no-gutters">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" v-model="task.completed">
                                    <span class="custom-control-indicator"></span>
                                </label>
                                <div class="col-sm task-text" @click="onClick()">
                                    <span>@{{ task.name }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 task-body task-footer">
                                <span>Создано: 8 Март 2017.</span>
                                <button class="action" data-toggle="modal" data-target="#exampleModal">Назначено: Вам и
                                    еще 4.
                                </button>
                                <span>Редактровать</span>
                            </div>
                        </div>
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
        
        // var app = new Vue({
        //     el: '#app',
        //     data: {
        //         message: 'Hello Vue!',
        //         tasks: []
        //     },
        //     created: function () {
        //         var self = this;
        //         axios.get('/api/tasks').then(response => {
        //             self.tasks = response.data;
        //         });
        //     },
        //     methods: {
        //         completeTask: function (id) {
        //             axios.delete('/tasks/' + id, {
        //                 _token: Laravel.csrfToken
        //             });
        //         }
        //     }
        // })
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