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

    <div v-else-if="loading" class="d-flex justify-content-center align-items-center text-center min-h-400px">

      <LoadingSimple />

    </div>

    <div v-else-if="items.length === 0" class="d-flex justify-content-center align-items-center text-center min-h-400px">

      <p> Nothing Found ! </p>

    </div>

    <div v-else class="table-responsive" >
      <table class="table table-striped table-hover table-row-bordered rounded border text-nowrap gx-3 gy-3">
        <thead>
          <tr class="fw-bold fs-6 text-muted">
            <th v-for="head in _heads">{{head }}</th>
          </tr>
        </thead>
        <tbody>
          <slot :items="items" />
        </tbody>
        <tfoot v-if="pages.length > 1">
          <tr>
            <td colspan="6" >
              <div class="d-flex justify-content-between align-items-center">

                <div>
                  <ul class="pagination">
                    <!--- prev --->
                    <li class="page-item previous" :class="{ 'disabled' : current_page === 1}">
                      <a class="page-link cursor-pointer" @click="changePage( current_page - 1)" :disabled="current_page === 1"><i class="previous"></i></a>
                    </li>
                    <!--- pages --->
                    <li v-for="page in pages" class="page-item " :class="{ 'active' : page === current_page }" >
                      <a class="page-link cursor-pointer" :disabled="page === current_page" @click="changePage(page)">{{  page }}</a>
                    </li>
                    <!--- next --->
                    <li class="page-item next" :class="{ 'disabled' : current_page === last_page }">
                      <a class="page-link cursor-pointer" @click="changePage( current_page + 1)" :disabled="current_page === last_page"><i class="next"></i></a>
                    </li>
                  </ul>
                </div>

                <div class="text-end">
                  <span class="fw-bold text-muted fs-7">
                    Showing {{ from }} to {{ to }} of {{ total }} records
                  </span>
                </div>

              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div>
</template>
<script>
export default {

  name : "TableSimple" ,

  data(){
    return {
      error : false ,
      loading : true ,
      items : [] ,
      pages : [],
      last_page : 1,
      current_page : 1 ,
      per_page : 12 ,
      to : 12 ,
      total : 0
    }
  },

  props : {
    _heads : {
      type : Array ,
      default : []
    },
    _fetchUrl : {
      type : String ,
      default : ""
    },
  },

  mounted() {
    this.fetchMethod()
  },

  computed : {
    from : function (){
      return this.per_page * ( this.current_page - 1 ) + 1 ;
    }
  },

  methods : {

    changePage( page ){

      if( this.current_page === page )
        return ;

      this.current_page = page ;
      this.fetchMethod()
    } ,

    fetchMethod(){

      this.error = false ;
      this.loading = true ;

      this.$axios.get(`${this._fetchUrl}?page=${this.current_page}`)

      .then( result => {
        this.error = false ;

        const { data ,meta } = result.data ;

        this.items = data ;

        if ( meta )
        {
          const { current_page ,total ,last_page ,per_page ,to } = meta ;

          let pages = [] ;

          for (let i = 1; i <= last_page ; i++) {
            pages.push(i)
          }

          this.current_page = current_page ;
          this.last_page = last_page ;
          this.pages = pages ;
          this.total = total ;
          this.per_page = per_page ;
          this.to = to ;
        }

      })

      .catch( err => {
        this.error = true ;
        console.log(err)
      })

      .finally( () => {
        this.loading = false ;
      })

    } ,

  }



}
</script>
<style scoped>
.head-th{
  padding-bottom: 1rem !important;
  padding-top: 1rem !important;
}
table td {
  font-size:.88rem!important
}
table th {
  font-size:.95rem!important
}
</style>
