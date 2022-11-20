<template>
  <div class="w-100 min-h-full d-flex justify-content-center align-items-center ">
    <div class="card shadow rounded bg-white min-w-300px max-w-400px">
      <div class="card-header">
        <h3 class="card-title">
          <Icon name="lock" color="primary" size="2x" class="ps-2" />
          فراموشی رمز عبور
        </h3>
      </div>
      <div class="card-body">
        <template v-if="!loading">
          <InputSolid
            _label="نام کاربری"
            _placeholder="نام کاربری خود را وارد کنید"
            :updateHook="val => username = val"
            :_default_value="username"
          />
          <p class="text-muted">
            پیامی حاوی لینک فراموشی برای شما ارسال خواهد شد,
            با کلیک روی لینک میتواند رمز عبور حساب کاربری خود را تغییر دهید.
          </p>
        </template>
        <template v-else >
          <LoadingSimple h="300" v-if="loading" />
        </template>
      </div>
      <div class="card-footer text-center" v-if="!loading">
        <button class="btn btn-sm w-100 btn-primary mb-3" @click="forgotPassword">ارسال لینک فراموشی</button>
        <nuxt-link class="text-primary" to="/auth/login">بازگشت به صفحه ورود</nuxt-link>
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
      loading : false ,
      username : "ilidan" ,
    }
  },

  methods : {
    forgotPassword(){
      this.loading = true
      this.$axios.$post("/api/admin/auth/forgot-password",{
        "username": this.username ,
      })
      .then(() => {
        this.$swal({
          icon : "success" ,
          title : "موفقیت" ,
          text : "پیامی حاوی لینک فراموشی برای شما ارسال شد."
        })
        this.$router.push("/auth/login")
      })
        .finally( () => this.loading = false )
    }
  }

}
</script>
