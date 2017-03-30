@extends('layouts.app')
@section('content')
<div id="task-app" class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between no-gutters">
                        @if(!auth()->guest())
                            @if(auth()->user()->hasRole("admin"))
                                <div>
                                    <a class="btn btn-success" href="/tasks/create">Create task</a>
                                    <button class="btn btn-primary" :class="{ 'btn-outline-primary': !showAll }" @click="showAll = !showAll">Show all tasks</button>
                                </div>
                                <button class="btn btn-primary" :class="{ 'btn-outline-primary': !showCompleted }" @click="showCompleted = !showCompleted">Show completed</button>
                            @else
                                <span>Task list</span>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-block">
                    <div v-for="(task, index) in tasks" class="task" :class="{ opened: active === index, done: task.completed }" v-if="isTaskVisible(index)">
                        <div class="row no-gutters">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" v-model="task.completed" @click="completeTask(index)">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <div class="col-sm task-text" @click="active = index">
                                <span :contenteditable="editing && (active === index)"
                                    @keyup.enter="editTask">@{{ task.name }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12 task-body task-footer">
                            <span>@{{ task.updated_at }}</span>
                            <button class="action" data-toggle="modal" data-target="#assignModal">@{{ assignedInfo(index) }}</button>
                            <button class="action" @click="editing = !editing">Edit task <span v-if="editing">(hit Enter to save)</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assigned users</h5>
          </div>
          <div class="modal-body" v-if="active != -1">
            <ul class="list-group" @click="searchingUser = false">
              <li v-for="(user, userIdx) in tasks[active].users" class="list-group-item justify-content-between">
                @{{ user.name }}
                <button class="btn btn-outline-danger btn-sm" @click="tasks[active].users.splice(userIdx, 1)">Delete</button>
              </li>
            </ul>
            <div class="form-group users-ac-wrapper">
                <input v-model="userQuery" type="text" class="form-control" placeholder="Search users"
                    @focus="searchingUser = true">
                <div class="list-group users-ac" v-if="searchingUser">
                  <button v-for="user in matchedUsers" type="button" class="list-group-item list-group-item-action"
                    :disabled="isUserAssigned(user.id, active)"
                    @click="tasks[active].users.push(user)">@{{ user.name }}</button>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" @click="saveAssigments()" data-dismiss="modal">Save</button>
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
            users: [],
            userQuery: '',
            searchingUser: false,
            active: -1,
            editing: false,
            showCompleted: false, // показать "готовые" задачи
            showAll: false // показать задачи не назначеные вам
        },
        created: function () {
            axios.get('/api/tasks').then(response => {
                this.tasks = response.data;
            });
            axios.get('/api/users').then(response => {
                this.users = response.data;
            });
        },
        computed: {
            matchedUsers: function () {
                var ret = [];
                var self = this;
                this.users.forEach(function (user) {
                    if (user.name.indexOf(self.userQuery) != -1)
                        ret.push(user);
                });
                return ret;
            }
        },
        methods: {
            completeTask: function (idx) {
                var task = this.tasks[idx];
                axios.put('/api/tasks/' + task.id, {
                    id: task.id,
                    completed: task.completed
                });
            },
            isTaskVisible: function (idx) {
                if (!this.showAll && !this.isSelfAssigned(idx))
                    return false
                if (this.showCompleted && !this.tasks[idx].completed)
                    return false;
                if (this.showAll && !this.showCompleted && this.tasks[idx].completed)
                    return false;
                if (!this.showCompleted && this.tasks[idx].completed)
                    return false;
                return true;
            },
            assignedInfo: function (idx) {
                var task = this.tasks[idx];
                var str = '';
                var selfAssigned = this.isUserAssigned(Laravel.user_id, idx);
                if (selfAssigned) {
                    str = 'Assigned: You';
                    var othersNum = task.users.length - 1;
                    if (othersNum) {
                        str += ' and ' + othersNum + ' others';
                    }
                } else {
                    str = 'Assign task';
                }
                return str;
            },
            isUserAssigned: function (userId, taskIdx) {
                var exist = false;
                this.tasks[taskIdx].users.forEach(function (user) {
                    if (userId === user.id) exist = true;
                });
                return exist;
            },
            isSelfAssigned: function (taskIdx) {
                return this.isUserAssigned(Laravel.user_id, taskIdx);
            },
            editTask: function (e) {
                e.target.innerHTML = e.target.textContent;
                var task = this.tasks[this.active];
                task.name = e.target.textContent;
                axios.put('/api/tasks/' + task.id, {
                    id: task.id,
                    name: task.name
                });
                this.editing = false;
            },
            saveAssigments: function () {
                var task = this.tasks[this.active];
                axios.put('/api/tasks/' + task.id, {
                    id: task.id,
                    users: task.users
                });
            }
        }
    })
</script>
@endsection
