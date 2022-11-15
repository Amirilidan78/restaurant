<!--- Item -->
<template>
  <div class="menu-item menu-lg-down-accordion" @click.stop="_hide">
    <a @click="() => _click()" class="menu-link cursor-pointer py-3 text-dark text-hover-danger" >
      <Icon
        v-if="_icon"
        :name="_icon"
        color="nothing"
        size="3"
      />
      <span class="menu-title mx-2">
        {{ _title }}
      </span>
    </a>
  </div>
</template>
<script>
export default {

  name : "DropdownItem",

  props : {
    _icon : {
      type : String ,
      default : ""
    } ,
    _title : {
      type : String ,
      default : "title"
    },
    _click : {
      type : Function ,
      default : () => {}
    },
    _hide : {
      type : Function ,
      default : () => {}
    },
  }

}
</script>
