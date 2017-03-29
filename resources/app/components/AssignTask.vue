<template>
  <div>
    <div class="modal fade" id="exampleModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Участники</h5>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <li v-for="user in users" class="list-group-item justify-content-between">
                {{ user.login }}
                <span class="btn btn-outline-danger btn-sm">Убрать</span>
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="button" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      users: [
        {
          login: 'Vasya'
        },
        {
          login: 'Sveta'
        },
        {
          login: 'Petya'
        }
      ]
    }
  }
}
</script>

<style>
</style>
