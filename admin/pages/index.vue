<template>
  <div>
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
</template>

<script>
export default {

  layout: "admin",

  middleware: ['auth'],

  methods: {
    test(...args){
      console.log(args)
    }
  }

}
</script>
