<template>
  <div class="d-flex flex-column justify-content-center align-items-center">
    <ScaleOut background="#d4d4d4" />
    <span class="pt-3">{{ text }}</span>
  </div>
</template>
<script>
import { ScaleOut } from "vue-loading-spinner" ;

export default {

  name : "LoadingSimple" ,

  components : {
    ScaleOut
  },

  props : {
    text : {
      default : "Loading ..." ,
      type : String
    }
  }

}
</script>
