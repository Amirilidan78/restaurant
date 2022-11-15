<template>
  <div class="menu-item menu-accordion overflow-hidden " :class="{ 'menu-item-selected' : currentRoute === _to }">
    <nuxt-link class="menu-link py-2" :to="_to">
      <span class="menu-title d-flex justify-content-start align-items-center fx-5" :class="{ 'menu-title-selected' : currentRoute === _to }">
        <Icon
          :name="_icon"
          :color="currentRoute === _to ? 'primary' : 'nothing'"
          size="2"
          _class="me-2 my-1"
        />
        {{ _title }}
      </span>
    </nuxt-link>
  </div>
</template>
<script>
export default {

  name : "AsideSingleItem" ,

  computed : {
    currentRoute() {
      return this.$route.path
    }
  },

  props : {
    _icon : {
      type : String ,
      default : ""
    },
    _title : {
      type : String ,
      default : ""
    },
    _to : {
      type : String ,
      default : "/"
    },
  },

}
</script>
