<template>
  <div>

    <div>
      <label for="username">username</label>
      <input type="text" v-model="username">
    </div>

    <div>
      <label for="password">password</label>
      <input type="password" v-model="password">
    </div>

    <div>
      <button @click="login">Submit</button>
    </div>

  </div>
</template>

<script>
export default {

  middleware: ['guest'] ,

  data(){
    return {
      "username" : "ilidan" ,
      "password" : "Amir.23334152" ,
    }
  },

  methods : {
    login(){

      this.$axios.$post("/api/admin/auth/login",{
        "username": this.username ,
        "password": this.password ,
      })

        .then(({ token, model }) => {
          this.$auth.setToken(token)
          this.$auth.setModel(model)
          this.$router.push("/")
        })

        .catch( err => console.log(err) )
    }
  }

}
</script>
