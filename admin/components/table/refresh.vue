<template>
  <div class="d-flex align-items-center ps-3">
    <button class="btn btn-icon btn-active-icon-danger" @click="refreshTable" @dblclick="clearTable"  custom-title="Click = refresh DbClick = clear" >
      <Icon name="refresh" color="nothing" />
    </button>
  </div>
</template>
<script>
export default {

  name : "TableRefresh" ,

  props : {
    table : {
      type : String ,
      default : ''
    },
    parent_ref : {
      type : Object ,
      default : () => {}
    },
  } ,

  methods : {

    refreshTable(){

      const table_ref = this.parent_ref[this.table] ;

      if( table_ref )
        if( table_ref.fetchMethod )
          table_ref.fetchMethod()

    },

    clearTable(){

      const table_ref = this.parent_ref[this.table] ;

      if( table_ref )
        if( table_ref.clearSearch )
          table_ref.clearSearch()

    },

  }
}
</script>
