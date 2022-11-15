<template>
  <div class="modal" :class="modalClass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" :class="modalSize">
      <div class="modal-content" v-if="_show">

        <div class="modal-header card-header-stretch py-0" v-if=" with_tabs === true ">

          <h6 class="modal-title py-7 fw-bold d-flex align-items-center">
            <slot name="header" />
          </h6>

          <div class="card-toolbar"  >
            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
              <li class="nav-item" v-for=" tab_item of tabs ">
                <a class="nav-link cursor-pointer px-3 py-8" :class="{ 'active' : tab === tab_item  }" @click="() => change_tab(tab_item)" >
                  {{ tab_item }}
                </a>
              </li>
            </ul>
          </div>

        </div>

        <div class="modal-header" v-else >

          <h6 class="modal-title fw-bold d-flex align-items-center">
            <slot name="header" />
          </h6>

          <div class="btn btn-icon btn-sm btn-active-light " @click="_dismissHook" >
            <Icon name="cross" color="secondary" />
          </div>

        </div>


        <div class="modal-body">
          <slot name="body" />
        </div>

        <div class="modal-footer">
          <slot name="footer" />
        </div>

      </div>
    </div>
  </div>
</template>
<script>
 export default {

   name : "ModalCenter" ,

   props : {


     tab : {
       type : String ,
       default : ""
     },
     tabs : {
       type : Array ,
       default : () => []
     },
     change_tab : {
       type : Function ,
       default : () => {}
     },
     with_tabs : {
       type : Boolean ,
       default : false
     },


     _show : {
       type : Boolean ,
       default : false
     },
     _size : {
       type : String ,
       default : "md"
     },
     _dismissHook : {
       type : Function ,
       default : () => {}
     }
   },

   computed : {
     modalSize(){
       return `modal-${this._size}`
     },
     modalClass(){
       return this._show ? 'bg-opacity-50 bg-secondary fade show d-block' : "d-none" ;
     }
   }
 }
</script>
<style>

</style>
