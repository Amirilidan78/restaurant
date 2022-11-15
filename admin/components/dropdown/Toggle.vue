<!--- Toggle -->
<template>
  <span class="menu-link py-3 px-1" @mouseenter="() => _hover ? _show() : null" @click="_toggle">
    <slot />
  </span>
</template>
<script>
export default {
name : "DropdownToggle",
  props : {
    _hover : {
      type : Boolean ,
      default : false
    },
    _show : {
      type : Function ,
      default : () => {} ,
    },
    _toggle : {
      type : Function ,
      default : () => {} ,
    },
  }
}
</script>
