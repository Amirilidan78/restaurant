<template>
  <div v-if="!loading">

    <section>

      <h3>Profile</h3>

      <div>
        <label for="first_name">First name</label>
        <input type="text" v-model="profile.first_name">
      </div>

      <div>
        <label for="first_name">Last name</label>
        <input type="text" v-model="profile.last_name">
      </div>

      <div>
        <label for="email">Email</label>
        <input type="text" v-model="profile.email">
      </div>

      <div>
        <label for="phone">Phone</label>
        <input type="text" v-model="profile.phone">
      </div>

      <div>
        <label for="avatar">Avatar</label>
        <img :src="profile.avatar" alt="avatar" height="100px" >
        <input type="file" @input="changeAvatar">
      </div>

      <button @click="updateProfile">Submit</button>

    </section>

    <hr>

    <section>

      <h3>Password</h3>

      <div>
        <label for="password">Password</label>
        <input type="text" v-model="password">
      </div>

      <div>
        <label for="confirm_password">Confirm password</label>
        <input type="text" v-model="confirm_password">
      </div>

      <button @click="updatePassword">Submit</button>

    </section>

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
