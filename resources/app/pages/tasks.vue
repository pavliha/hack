<template>
  <div class="row justify-content-sm-center">
    <div class="col-sm-6">
      <template v-for="(task, index) in tasks" v-if="!task.done">
        <task :task-idx="index"></task>
      </template>
      <button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#tasksDone">
        Показать завершенные задачи
      </button>
      <div class="collapse" id="tasksDone">
        <template v-for="(task, index) in tasks" v-if="task.done">
          <task :task-idx="index"></task>
        </template>
      </div>
    </div>
    <assign-task></assign-task>
  </div>
</template>

<script>
import Task from '~components/Task.vue'
import AssignTask from '~components/AssignTask.vue'

export default {
  data () {
    return {
      tasks: [
        {
          id: 1,
          name: 'Это пример задания с очень длинным названием. Посмотрим как оно поместится здесь.',
          assigned_to: [1, 2, 3],
          done: false
        },
        {
          id: 2,
          name: 'Закончить проект',
          assigned_to: [3],
          done: true
        }
      ]
    }
  },
  components: {
    Task,
    AssignTask
  }
}
</script>

<style>
#tasksDone {
  margin-top: 8px;
}
</style>
