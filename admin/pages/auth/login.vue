<template>
  <div class="w-100 min-h-full d-flex justify-content-center align-items-center ">
    <div class="card shadow rounded bg-white min-w-300px">
      <div class="card-header">
        <h3 class="card-title">
          <Icon name="shield_user" color="primary" size="2x" class="ps-2" />
          ورود به حساب کاربری
        </h3>
      </div>
      <div class="card-body">
        <InputSolid
          _label="نام کاربری"
          _placeholder="نام کاربری خود را وارد کنید"
          :updateHook="val => username = val"
          :_default_value="username"
        />
        <InputSolid
          _label="رمز عبور"
          _placeholder="رمز عبور خود را وارد کنید"
          :updateHook="val => password = val"
          :_default_value="password"
          _type="password"
        />
      </div>
      <div class="card-footer text-center">
        <button class="btn btn-sm w-100 btn-primary mb-3" @click="login">ورود</button>
        <nuxt-link class="text-primary" to="/auth/forgot-password">رمز عبور خود را فراموش کرده اید ؟</nuxt-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  layout: "default",

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
