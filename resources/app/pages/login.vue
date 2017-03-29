<template>
  <div class="row justify-content-sm-center">
    <div class="col-sm-4">
      <form @submit.prevent="onLoginSubmit">
        <div class="form-group">
          <label for="login">Логин</label>
          <input type="text" class="form-control" id="login" v-model="loginForm.login">
        </div>
        <div class="form-group">
          <label for="password">Пароль</label>
          <input type="password" class="form-control" id="password" v-model="loginForm.password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      loginForm: {
        login: '',
        password: ''
      },
      error: {
        login: '',
        password: ''
      },
      loading: false
    }
  },
  methods: {
    onLoginSubmit () {
      if (this.loginForm.login === 'admin' &&
          this.loginForm.password === 'admin') {
        this.$auth.setUser({
          id: 7,
          login: 'admin',
          role: 1
        })
        this.$router.push('/tasks')
      }
    }
  }
}
</script>
