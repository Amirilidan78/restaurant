<!--- Items Container -->
<template>
  <div class="menu-sub menu-sub-down-accordion menu-sub-dropdown menu-rounded-0 py-4 w-200px " :class="extra_class" >
    <slot/>
  </div>
</template>
<script>
export default {
name : "DropdownItems",
  props : {

    _class : {
      type : String ,
      default : ''
    },

  },

  computed : {
    extra_class(){
      return this._class ;
    }
  }
}
</script>
<style>
  .account-dropdown-toggle {
    position: absolute !important;
  }
</style>
