<template>
  <div :class="`h-${h}px`" class="w-100 d-flex justify-content-center align-items-center">
    <ScaleOut background="#d4d4d4" />
  </div>
</template>
<script>
import { ScaleOut } from "vue-loading-spinner" ;

export default {
  name : "LoadingSimple" ,
  components : {
    ScaleOut
  },
  props: {
    h : {
      type : Number|String ,
      default : 60
    },
  }
}
</script>
