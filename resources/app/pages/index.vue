<template>
  <div class="text-center">
    <img src="~assets/splash.png" alt="" class="img-fluid splash">
    <h2>Добро пожаловать!</h2>
    <div>Для начала работы необходимо 
      <nuxt-link class="auth-link" to="/login">Войти</nuxt-link> или
      <nuxt-link class="auth-link" to="/register">Зарегистрироваться</nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
}
</script>

<style>
.auth-link {
  border-bottom: 1px dashed #a6a6a6;
  color: #a6a6a6;
}

.auth-link:hover {
  text-decoration: none;
  color: #000;
  border-color: #000;
}

.splash {
  width: 120px;
  margin-bottom: 32px;
}
</style>
