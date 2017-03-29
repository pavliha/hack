<template>
  <div>
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">TSKMGR</a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto" v-if="$auth.check()">
            <li class="nav-item">
              <nuxt-link class="nav-link" to="/tasks">Задания</nuxt-link>
            </li>
            <li class="nav-item" v-if="$auth.user().role === 1">
              <a class="nav-link" href="#">Добавить задание</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <template v-if="!$auth.check()">
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/login">Войти</nuxt-link>
              </li>
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/register">Регистрация</nuxt-link>
              </li>
            </template>
            <li class="nav-item dropdown" v-else>
              <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown">{{ $auth.user().login }} ({{ friendlyRole }})</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#" @click.prevent="logOut()">Выйти</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container main">
      <nuxt></nuxt>
    </div>
  </div>
</template>

<script>
export default {
  beforeCreate () {
    this.$auth.setStore(this.$store)
    if (process.BROWSER_BUILD) {
      this.$auth.initUser()
    }
  },
  computed: {
    friendlyRole () {
      switch (this.$auth.user().role) {
        case 1:
          return 'Начальник'
        case 2:
          return 'Тимлид'
        case 3:
          return 'Работник'
      }
    }
  },
  methods: {
    logOut () {
      this.$auth.logOut()
      this.$router.push('/')
    }
  }
}
</script>

<style>
.container.main {
  margin-top: 88px;
}
</style>
