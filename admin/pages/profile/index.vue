<template>
  <div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">اطلاعات حساب کاربری</h3>
          </div>
          <div class="card-body">
            <div class="row" v-if="loading">
              <div class="col-12">
                <LoadingSimple h="300"  />
              </div>
            </div>
            <div class="row" v-else >
              <div class="col-lg-7">

                <InputSolid
                  _label="نام"
                  _placeholder="نام را وارد کنید"
                  :updateHook="val => profile.first_name = val"
                  :_default_value="profile.first_name"
                />

                <InputSolid
                  _label="نام خانوادگی"
                  _placeholder="نام خانوادگی را وارد کنید"
                  :updateHook="val => profile.last_name = val"
                  :_default_value="profile.last_name"
                />

                <InputSolid
                  _label="ایمیل"
                  _placeholder="ایمیل را وارد کنید"
                  :updateHook="val => profile.email = val"
                  :_default_value="profile.email"
                />

                <InputSolid
                  _label="شماره همراه"
                  _placeholder="شماره همراه را وارد کنید"
                  :updateHook="val => profile.phone = val"
                  :_default_value="profile.phone"
                />

              </div>
              <div class="col-lg-5 d-flex justify-content-center align-items-center text-center">
                <div>
                  <div>
                    <img :src="profile.avatar ?? avatarCallback" alt="avatar" height="250px" width="250px" class="cursor-pointer rounded-circle" @click="() => $refs.profile_avatar.click()" >
                    <input type="file" hidden ref="profile_avatar" @input="changeAvatar">
                  </div>
                  <div v-if="profile.avatar">
                    <button class="btn btn-danger btn-sm mt-3" @click="() => profile.avatar = null"> حذف عکس پروفایل</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-primary btn-sm" @click="updateProfile">ویرایش</button>
          </div>
        </div>
      </div>
    </div>


    <div class="row mt-5 ">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">تغییر رمز عبور</h3>
          </div>
          <div class="card-body">
            <div class="row" v-if="loading">
              <div class="col-12">
                <LoadingSimple h="300"  />
              </div>
            </div>
            <div class="row" v-else >
              <div class="col-lg-9">

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
            </div>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-primary btn-sm" @click="updatePassword">تغییر</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {

  layout: "admin",

  middleware: ['auth'],

  data() {
    return {
      loading: true ,
      profile: null ,
      password: "" ,
      confirm_password: "" ,
      avatarCallback: "/avatar.png",
    }
  },

  created() {
    this.fetchProfile()
  },

  methods: {

    fetchProfile(){
      this.loading = true
      this.$axios.get("/api/admin/profile/get-profile")
        .then(({data}) => this.profile = data.data )
        .catch( err => console.log(err) )
        .finally( () => this.loading = false )
    },

    updateProfile(){
      this.loading = true
      this.$axios.post("/api/admin/profile/update-profile",this.profile)
        .then( () => this.$swal_success() )
        .catch( err => console.log(err) )
        .finally( () => this.loading = false )
    },

    updatePassword(){

      if( this.password !== this.confirm_password )
        return this.$swal_error("password and confirm password does not match!")

      this.loading = true
      this.$axios.post("/api/admin/profile/update-password",{
        "password": this.password,
      })
        .then( () => this.$swal_success() )
        .catch( err => console.log(err) )
        .finally( () => this.loading = false )
    },

    changeAvatar(e){
      const file = e.target.files[0]
      const reader = new FileReader();
      reader.onloadend = () => {
        this.profile.avatar = reader.result
      }
      reader.readAsDataURL(file);
    }

  },

}
</script>
