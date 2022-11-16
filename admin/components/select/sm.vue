<template>
  <SelectSingle
    :_disabled="_disabled"
    :_sm="true"
    :updateHook="updateHook"
    :_label="_label"
    :_options="_options"
    :_searchable="_searchable"
    :_placeholder="_placeholder"
    :_required="_required"
    :errorHook="errorHook"
    :_default_value="_default_value"
  />
</template>
<script>
export default {

  name : "SelectSm",

  props : {

    _disabled : {
      type : Boolean ,
      default : false
    },

    updateHook : {
      type : Function ,
      default : () => {}
    },

    _label : {
      type : String ,
      default : "Label"
    },

    _options : {
      type : Array ,
      default : () => []
    },

    _searchable : {
      type : Boolean ,
      default : false
    },

    _placeholder : {
      type : String ,
      default : "Select an option"
    },

    _required : {
      type : Boolean ,
      default : false
    },

    errorHook : {
      type : Function ,
      default : () => {}
    },

    _default_value : {
      type : Object ,
      default : () => { return {} }
    },

  },

}
</script>
<style>

.multiselect{
  cursor: pointer;
}

.multiselect--disabled .multiselect__current, .multiselect--disabled .multiselect__select {
  background: none !important;
}
.multiselect--disabled {
  background: none !important;
  cursor: not-allowed !important;
}

  .label-select {
    font-size: .85rem !important;
  }
  .multiselect__tags {
    font-size: .85rem !important ;
    min-height: 0 !important ;
    padding: .4rem .5rem .1rem .5rem !important ;
  }
</style>
