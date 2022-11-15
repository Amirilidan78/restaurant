<template>
  <div class="w-100 min-h-full d-flex justify-content-center align-items-center ">

    <template v-if="loading">
      <LoadingFullPageLoading />
    </template>

    <template v-if="!valid">
      <div class="card shadow rounded bg-white min-w-300px max-w-400px">
        <div class="card-header">
          <h3 class="card-title">
            <Icon name="lock" color="primary" size="2x" class="ps-2" />
            ویرایش رمز عبور
          </h3>
        </div>
        <div class="card-body">
          <p>لینک فراموشی رمز عبور نامعتبر یا منقضی شده است</p>
        </div>
        <div class="card-footer text-center">
          <nuxt-link class="text-primary" to="/auth/login">بازگشت به صفحه ورود</nuxt-link>
        </div>
      </div>
    </template>

    <template v-else>
      <div class="card shadow rounded bg-white min-w-300px max-w-400px">
        <div class="card-header">
          <h3 class="card-title">
            <Icon name="lock" color="primary" size="2x" class="ps-2" />
            ویرایش رمز عبور
          </h3>
        </div>
        <div class="card-body">
          <InputSolid
            _label="رمز عبور جدید"
            _placeholder="رمز عبور جدید را وارد کنید"
            :updateHook="val => password = val"
            :_default_value="password"
            _type="password"
          />
          <InputSolid
            _label="تکرار رمز عبور جدید"
            _placeholder="تکرار رمز عبور جدید را وارد کنید"
            :updateHook="val => confirm_password = val"
            :_default_value="confirm_password"
            _type="password"
          />
        </div>
        <div class="card-footer text-center">
          <button class="btn btn-sm w-100 btn-primary mb-3" @click="resetPassword">تغییر رمز عبور</button>
          <nuxt-link class="text-primary" to="/auth/login">انصراف</nuxt-link>
        </div>
      </div>
    </template>

  </div>
</template>

<script>
export default {

  layout: "default",

  middleware: ['guest'] ,

  data(){
    return {
      "loading": true,
      "valid": false,
      "token": "" ,
      "password": "" ,
      "confirm_password": "" ,
    }
  },

  created() {
    const { token } = this.$route.query
    this.token = token
    this.validateToken()
  },

  methods : {

    validateToken(){
      this.loading = true
      this.$axios.$post("/api/admin/auth/validate-forgot-password",{
        "token": this.token ?? "invalid" ,
      })
        .then(() => this.valid = true )
        .finally(() => this.loading = false )
    },

    resetPassword(){
      if ( this.password !== this.confirm_password )
        return this.$swal_error("رمز عبور با تکرار رمز عبور مطابقت ندارد")

      this.loading = true
      this.$axios.$post("/api/admin/auth/reset-password",{
        "token": this.token ,
        "password": this.password ,
      })
        .then(() => {
          this.$swal({
            icon : "success" ,
            title : "موفقیت" ,
            text : "رمز عبور حساب شما با موفقیت تغییر کرد"
          })
          this.$router.push("/auth/login")
        })
        .finally(() => this.loading = false )
    },

  }

}
</script>
