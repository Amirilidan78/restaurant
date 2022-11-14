<template>
  <div>
    <header>
      <div>
        <nuxt-link to="/">Dashboard</nuxt-link>
        <nuxt-link to="products">Products</nuxt-link>
        <nuxt-link to="meals">Meals</nuxt-link>
        <nuxt-link to="users">Users</nuxt-link>
        <nuxt-link to="profile">Profile</nuxt-link>
        <nuxt-link to="logout">Logout</nuxt-link>
      </div>
    </header>
    <Nuxt/>
  </div>
</template>
<script>
export default {

}
</script>
<style>
  a {
    margin: 10px ;
  }
</style>
