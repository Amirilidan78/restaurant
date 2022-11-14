<template>
  <div>

    <div v-if="error" class="d-flex justify-content-center align-items-center text-center min-h-400px">

      <div>

        <p>
          Something went wrong
        </p>

        <button class="btn btn-icon" @click="fetchMethod">
          <Icon name="refresh" color="primary" size="1" />
        </button>

      </div>

    </div>

    <div v-else>

      <div class="table-responsive mb-0 pb-0">
        <table class="table table-striped table-hover table-row-bordered rounded border text-nowrap mb-3 gx-3 gy-3" >

          <thead>
            <tr class="fw-bold text-muted ">
              <th
                v-for="(head,index) in _heads"
                :custom-title="_searches[index] ? `${_searches[index].type}` : 'No search available'"
                class="head-th"
                :style="`${getHeadCustomWithClass(index)}`"
                :data-sort-key="getItemSortKey(_searches[index])"
                :data-sort-dir="getItemSortDir(_searches[index])"
                :class="{ 'cursor-pointer' : getItemSortKey(_searches[index]) !== null ,'text-primary' : getItemSortDir(_searches[index]) === 'asc' ,'text-warning' : getItemSortDir(_searches[index]) === 'desc' }"
                @click="doSort"
                >
                  <Icon v-if=" getItemSortDir(_searches[index]) === 'asc' " name="arrow-up" size="2" color="primary" />
                  <Icon v-if=" getItemSortDir(_searches[index]) === 'desc' " name="arrow-down" size="2" color="warning" />
                  {{ head }}
              </th>
            </tr>
            <tr>
              <th class="search-item head-th" v-for="item of _searches">

                <span v-if="item === null">
                  <input
                    disabled
                    class="form-control form-control-solid form-control-sm text-start"
                    placeholder="search is disabled"
                  >
                </span>

                <input
                  v-else-if="item.input === 'text'"
                  type="text"
                  class="form-control form-control-solid form-control-sm text-start"
                  :value="search[item.key] ? search[item.key].value : item.default_value "
                  @input="event => updateSearch(  item ,event.target.value )"
                >

                <input
                  v-else-if="item.input === 'number'"
                  type="number"
                  class="form-control form-control-solid form-control-sm text-start"
                  :value="search[item.key] ? ( search[item.key].value ? parseFloat(search[item.key].value) : null ) : ( item.default_value ? parseFloat(item.default_value) : null  ) "
                  @input="event => updateSearch(  item ,event.target.value ? parseFloat(event.target.value) : '' )"
                >

                <DatePickerBare
                  v-else-if="item.input === 'date'"
                  :_for_table="true"
                  _placeholder=""
                  :updateHook="val => updateSearch( item ,val )"
                  :_default_value="search[item.key] ? search[item.key].value : ''"
                />

                <select
                  v-else-if="item.input === 'select'"
                  class="form-select form-select-solid form-select-sm"
                  @change="e => updateSearch( item , { key : e.target.options[e.target.selectedIndex].value ,name : e.target.options[e.target.selectedIndex].text } )"
                  :value="search[item.key] ? search[item.key].value.key : 'nothing-is-selected'"
                >
                  <option value="nothing-is-selected"></option>
                  <option
                    v-for="_option of item.values"
                    :selected="search[item.key] ? search[item.key].val == _option.key : false"
                    :value="_option.key">{{ _option.name }}</option>
                </select>

              </th>
            </tr>
          </thead>

          <template v-if="loading">
            <tbody>
              <tr>
                <td :colspan="_heads.length" >
                  <div class="d-flex justify-content-center align-items-center text-center min-h-400px">
                    <LoadingSimple />
                  </div>
                </td>
              </tr>
            </tbody>
          </template>

          <template v-else>

            <tbody v-if="items.length !== 0" >
              <slot name="body" :items="items"  />
            </tbody>

            <tbody v-if="items.length === 0">
              <tr>
                <td class="text-center h-200px" :colspan="_heads.length"> No record found ! </td>
              </tr>
            </tbody>

            <tfoot v-if="links.length > 1">
              <tr>
                <td :colspan="_heads.length" >
                  <div class="d-flex justify-content-between align-items-center">

                    <div class="py-4 ">
                      <ul class="pagination">

                        <template v-for="(link,key) of links">

                          <!--- prev --->
                          <li v-if="link.label === 'pagination.previous'" class="page-item previous" :class="{ 'disabled' : 1 === current_page}" >
                            <a class="page-link fs-7 cursor-pointer" @click="() => changePage( current_page - 1)" :disabled="1 === current_page"><i class="previous"></i></a>
                          </li>

                          <!--- next --->
                          <li v-else-if="link.label === 'pagination.next'" class="page-item next" :class="{ 'disabled' : last_page === current_page }">
                            <a class="page-link fs-7 cursor-pointer" @click="() => changePage( current_page + 1)" :disabled="last_page === current_page"><i class="next"></i></a>
                          </li>

                          <!--- ... --->
                          <li v-else-if="link.label === '...'" class="page-item d-flex align-items-center justify-content-center" >
                            . . .
                          </li>

                          <!--- page --->
                          <li v-else class="page-item " style="background: #f3f6f9 ; border-radius: 5px" :class="{ 'active' : link.active }" >
                            <a class="page-link fs-7 cursor-pointer" :disabled="parseInt(link.label) === current_page" @click="() => changePage(parseInt(link.label))">{{  link.label }}</a>
                          </li>

                        </template>

                      </ul>
                    </div>

                    <div class="text-end">
                      <span class="fw-bold text-muted fs-7 d-flex justify-content-center align-items-center">
                        Showing {{ from }} to {{ to }} of {{ total }} records
                        <select
                          class="form-select form-select-solid form-select-sm ms-2"
                          :value="per_page"
                          @change="e => per_page = e.target.options[e.target.selectedIndex].value"
                        >
                          <option value="15">15</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select>

                      </span>
                    </div>

                  </div>
                </td>
              </tr>
            </tfoot>

          </template>

        </table>
      </div>

    </div>

  </div>
</template>
<script>
export default {

  name : "TableOffline" ,

  data(){
    return {
      sort : {
        key : null ,
        dir : null ,
      },
      search : {} ,
      searchTimeout : null ,
      error : false ,
      loading : true ,
      all_items : [] ,
      items : [] ,
      pages : [],
      current_page : 1 ,
      per_page : 15 ,
    }
  },

  props : {
    _heads : {
      type : Array ,
      default : () => []
    },
    _fetchUrl : {
      type : String ,
      default : ""
    },
    _searches : {
      type : Array ,
      default : []
    },
    _extra_payload : {
      type : Object ,
      default : () => {}
    },
    _default_sort_key : {
      type : String ,
      default : ""
    },
    _default_sort_dir : {
      type : String ,
      default : ""
    },
    _custom_width : {
      type : Array ,
      default : () => []
    },
  },

  mounted() {

    // sort on mounted
    this.sort.key = this._default_sort_key
    this.sort.dir = this._default_sort_dir

    // set default values
    let hasDefault = false

    for (const item of this._searches) {
      if( item )
        if ( item.default_value ) {
          this.updateSearch(item ,item.default_value)
          hasDefault = true
        }
    }

    if ( hasDefault === false )
      this.fetchMethod()
  },

  computed : {
    from : function (){
      return this.per_page * ( this.current_page - 1 ) + 1 ;
    },
    to : function (){
      return this.per_page * this.current_page ;
    },
    total : function (){
      return this.all_items.length ;
    },
    last_page : function (){
      return this.all_items.length / this.per_page ;
    },
    links : function (){

      const temp = []

      const count = this.all_items.length / this.per_page

      for (let i = 1; i <= count ; i++) {
        temp.push({
            label: i ,
            active: i === this.current_page ,
          }
        )
      }

      return temp ;
    },
  },

  methods : {

    changePage( page ){

      if( this.current_page === page )
        return ;

      this.current_page = page ;

      this.fetchItems()
    } ,

    fetchItems(){
      this.loading = true
      this.items = this.all_items.filter( (item,index) => index < this.to && index >= this.from - 1 )
      this.$nextTick( () => this.loading = false )
    },

    fetchMethod(){

      this.error = false ;
      this.loading = true ;

      let url = `${this._fetchUrl}?page=${this.current_page}` ;

      const _search = {} ;

      Object.entries(this.search).forEach(([key, val]) => {
        if( val.value !== "" || val.value !== null )
        {
          _search[key] = val ;

          if( val.input === 'select' )
            _search[key].val = _search[key].value.key ;
          else
            _search[key].val = _search[key].value ;
        }
      })

      this.$axios.post(url,this.$jsonToForm({
        search : _search ,
        sort : this.sort ,
        per_page : this.per_page ,
        ...this._extra_payload
      }))

      .then( result => {

        this.error = false ;
        this.all_items = result.data.data
        this.fetchItems()
      })

      .catch( err => this.error = true )

      .finally( () => this.loading = false )

    } ,

    updateSearch( item ,val ){

      this.search[item.key] = { ...item } ;

      if( item.input === 'select' )
      {
        if( !val || val.key === 'nothing-is-selected' )
          delete this.search[item.key]
        else
        {
          let key
          if ( val.key == 'true')
            key = true
          else if ( val.key == 'false')
            key = false
          else
            key = val.key

          this.search[item.key].value = {
            key : key ,
            name : val.name ,
          } ;

        }
      }
      else
        if( val.length === 0 && val === "" )
        {
          delete this.search[item.key]
        }
        else
        {
          this.search[item.key].value = val ;
        }

      if( this.searchTimeout )
      {
        clearTimeout( this.searchTimeout ) ;
      }

      this.searchTimeout = setTimeout( () => {
        this.current_page = 1
        this.fetchMethod() ;
      },1000) ;

    } ,

    clearSearch(){
      this.search = {} ;
      this.fetchMethod()
    } ,

    getItemSortDir( item ){
      if( item )
      {
        if( this.sort.key === item.key || this.sort.key === item.sort_key )
        {
          return this.sort.dir
        }
      }

      return null
    },

    getItemSortKey( item ){
      if( item )
        if( item.sort_key )
          return item.sort_key
        else
          return item.key
      else
        return null
    },

    doSort( e ){

      const sort_key = e.target.getAttribute('data-sort-key')
      const prev_sort_dir = e.target.getAttribute('data-sort-dir')
      // const prefix_dir = e.target.getAttribute('data-sort-prefix') ?? ''

      if( ! sort_key )
        return -1 ;

      if( prev_sort_dir === 'asc' )
        this.sort = {
          // key : prefix_dir + sort_key ,
          key : sort_key ,
          dir : 'desc' ,
        }
      else if( prev_sort_dir === 'desc' )
        this.sort = {
          // key : prefix_dir + sort_key ,
          key : sort_key ,
          dir : 'asc' ,
        }
      else
        this.sort = {
          // key : prefix_dir + sort_key ,
          key : sort_key ,
          dir : 'desc' ,
        }

      this.fetchMethod() ;
    },

    getHeadCustomWithClass( headIndex ){

      if ( this._custom_width.length + 1 >= headIndex ) {
        const item = this._custom_width[headIndex]
        if ( item !== null || item !== "" )
          return `width : ${item} !important;`
      }

      return `width : auto ;`

    }

  } ,

  watch : {
    per_page: function (newVal,preVal) {
      if (newVal != preVal)
        this.fetchMethod()
    }
  }

}
</script>
<style scoped>

  select {
    appearance: none;
  }
  option {
    background: white !important;
  }
  .full-td{
    display:block;width:99.9%;clear:both
  }
  .search-item{
    min-width: 150px;
  }
  .head-th{
    padding-bottom: 1rem !important;
    padding-top: 1rem !important;
  }

  @media only screen and (min-width: 800px) {
    table {
      table-layout: fixed;
    }
    table td {
      font-size:.89rem!important;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    table th {
      font-size:.95rem!important;
      padding: 0 10px !important;
      text-overflow: ellipsis;
    }
  }



  input {
    height: 35px ;
  }

  select {
    height: 35px ;
  }

  thead {
    overflow: visible ;
  }

  th {
    overflow: visible ;
  }

  tr {
    overflow: visible ;
  }

  table {
    overflow: visible ;
  }

  div {
    overflow: visible ;
  }


</style>
