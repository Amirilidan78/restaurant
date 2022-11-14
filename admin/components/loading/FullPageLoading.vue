<template>
  <div class="min-h-full bg-white z-index-max d-flex justify-content-center align-items-center">
    <LoadingSimple />
  </div>
</template>
<script>

export default {
  name : "LoadingFullPageLoading" ,
}
</script>
<style scoped>
.z-index-max {
  z-index: 9999999;
}
</style>
