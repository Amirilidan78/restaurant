<template>
  <div>
    <div class="row">
      <div class="col-12">
        <DatePickerSimple
          _label="12121212"
          _placeholder="asdasdasdasdasd"
          :_updateHook="test"
          _default_value=""
        />




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
