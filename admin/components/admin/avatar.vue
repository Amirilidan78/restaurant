<template>
  <img
    :class="`w-${w}px h-${h}px`"
    class="me-2 rounded-circle"
    :src="image ?? avatarCallback"
    alt="Avatar"
  >
</template>
<script>
export default {

  name : "Avatar" ,

  props : {

    w : {
      type : Number|String ,
      default : 35
    },

    h : {
      type : Number|String ,
      default : 35
    },

  },

  data(){
    return {
      image: null,
      avatarCallback: "/avatar.png",
    }
  },

  created() {
    this.getAvatar()
  },

  methods : {

    getAvatar(){
      this.$axios.$get("/api/admin/profile/get-avatar")
        .then( res => this.image = res.avatar )
    },

  }

}
</script>
