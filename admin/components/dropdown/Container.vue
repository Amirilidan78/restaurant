<template>
  <div class="menu-item menu-lg-down-accordion menu-dropdown " @mouseleave="() => _hover ? _hide() : null" :class="{ 'show' : _show }" v-click-outside="_hide" >
    <slot />
  </div>
</template>
<script>
  export default {

    name : "DropdownContainer",

    props : {
      _hover : {
        type : Boolean ,
        default : false
      },
      _show : {
        type : Boolean ,
        default : false
      },
      _hide : {
        type : Function ,
        default: () => {}
      }
    }

  }
</script>
