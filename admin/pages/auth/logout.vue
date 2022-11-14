<template>
  <div></div>
</template>

<script>
export default {

  middleware: ['auth'] ,

  created() {
    this.$auth.removeToken()
    this.$auth.removeModel()
    this.$router.push("/auth/login")
  },

}
</script>
