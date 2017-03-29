@extends('layouts.app')
@section('content')
<div id="task-app" class="container">
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
                    <div v-for="(task, index) in tasks" class="task" :class="{ opened: active === index }">
                        <div class="row no-gutters">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" v-model="task.completed" @click="completeTask(index)">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <div class="col-sm task-text" @click="active = index">
                                <span>@{{ task.name }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12 task-body task-footer">
                            <span>@{{ task.updated_at }}</span>
                            <button class="action" data-toggle="modal" data-target="#exampleModal">Assigned: You and 4 more.</button>
                            <a class="action" :href="'/tasks/' + task.id + '/edit'">Edit task</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assigned users</h5>
          </div>
          <div class="modal-body" v-if="active != -1">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search users (пока-что бесполезное говно)" autofocus>
            </div>
            <ul class="list-group">
              <li v-for="user in tasks[active].assigned" class="list-group-item justify-content-between">
                @{{ user.name }}
                <span class="btn btn-outline-danger btn-sm">Delete</span>
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
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
        el: '#task-app',
        data: {
            tasks: [],
            active: -1
        },
        created: function () {
            axios.get('/api/tasks').then(response => {
                // WORKING: this.tasks = response.data;
                // TEMP while not json:
                for (i in response.data) {
                    response.data[i].assigned = [
                        {
                            name: 'pavel',
                            id: 9
                        },
                        {
                            name: 'alex',
                            id: 7
                        }
                    ]
                }
                console.log(response.data);
                this.tasks = response.data;
                // DELETE ^^^^ when done api
            });
        },
        methods: {
            completeTask: function (idx) {
                var task = this.tasks[idx];
                axios.put('/api/tasks/' + task.id, {
                    id: task.id,
                    name: task.name,
                    description: task.description,
                    completed: task.completed,
                    _token: Laravel.csrfToken
                });
            }
        }
    })
</script>
@endsection
