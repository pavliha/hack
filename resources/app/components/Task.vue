<template>
  <div class="task" :class="{ opened: isOpened, done: task.done }">
    <div class="row no-gutters">
      <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" v-model="task.done">
        <span class="custom-control-indicator"></span>
      </label>
      <div class="col-sm task-text" @click="onClick()">
        <span>{{ task.name }}</span>
      </div>
      <div class="col-sm-12 task-body task-footer">
        <span>Создано: 8 Март 2017.</span>
        <button class="action" data-toggle="modal" data-target="#exampleModal">Назначено: Вам и еще 4.</button>
        <span>Редактровать</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      isOpened: false,
      task: null
    }
  },
  created () {
    this.task = JSON.parse(JSON.stringify(this.$parent.tasks[this.taskIdx]))
  },
  props: {
    taskIdx: {
      type: Number,
      required: true
    }
  },
  methods: {
    onClick () {
      this.isOpened = !this.isOpened
    }
  }
}
</script>

<style>
.task {
  border: 1px solid #ccc;
  padding: 8px 16px;
  margin-bottom: 8px;
  border-radius: 2px;
}

.custom-checkbox {
  margin-bottom: 0;
  margin-right: 8px;
}

.task .task-body {
  display: none;
  padding-left: 32px;
}

.task-text {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  cursor: pointer;
}

.task.done .task-text {
  text-decoration: line-through;
}

.task.opened .task-text {
  white-space: normal;
}

.task.opened .task-body {
  display: block;
}

.task.opened {
  border-color: #0275d8;
}

.task-footer {
  font-size: 14px;
  color: #848484;
  font-style: italic;
  margin-top: 8px;
}

.task-footer span {
  margin-right: 8px;
}

.task-footer .action {
  background: transparent;
  border: none;
  margin: 0;
  margin-right: 8px;
  padding: 0;
  font-size: 14px;
  color: #848484;
  font-style: italic;
  outline: none;
  cursor: pointer;
}
</style>
