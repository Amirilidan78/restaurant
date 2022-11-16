<template>
  <div >

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2" >امتیاز</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <p>
            {{ score.description }}
          </p>
        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-end">
          <button class="btn btn-sm btn-primary"  v-if="!score.is_accepted" @click="acceptScore">تایید و نمایش در سایت</button>
          <button class="btn btn-sm btn-danger" @click="deleteScore">حذف</button>
        </div>
      </template>
    </ModalCenter>

    <template>
      <div class="row mt-5 ">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">امتیاز ها</h3>
            </div>
            <div class="card-body">
              <TableSimple
                ref="table"
                _fetchUrl="/api/admin/meal-scores/index"
                :_heads="[ 'کاربر', 'غذا', 'تاریخ', 'امتیاز', 'تایید شده', 'عملیات' ]"
              >
                <template v-slot="{items}">
                  <tr v-for="item in items">
                    <td>{{ item.user.first_name }} {{ item.user.last_name }}</td>
                    <td>{{ item.meal_plan.meal.name }}</td>
                    <td>{{ item.meal_plan.date_jalali }}</td>
                    <td>{{ item.score }}</td>
                    <td>{{ item.is_accepted_text }}</td>
                    <td>
                      <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showModal(item)" >مشاهده</span>
                    </td>
                  </tr>
                </template>
              </TableSimple>
            </div>
          </div>
        </div>
      </div>
    </template>

  </div>
</template>
<script>
export default {
  layout: "admin",

  middleware: ['auth'],

  data() {
    return {
      modal_loading: false ,
      modal: false,
      score: {},
    }
  },

  created() {},

  methods: {

    hideModal(){
      this.modal = false
    },

    showModal(item){
      this.modal = true
      this.score = item
    },

    updateMealScore(){
      this.modal_loading = true
      this.$axios.post(`/api/admin/meal-scores/update/${this.score.id}`,this.score)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModal()
        })
        .finally( () => this.modal_loading = false )
    },

    acceptScore(){
      this.score.is_accepted = true
      this.updateMealScore()
    },

    deleteScore(){
      this.$confirmation({
        confirmed_then: () => {
          this.loading = true
          this.$axios.post(`/api/admin/meal-scores/delete/${this.score.id}`)
            .then( () => {
              this.$swal_success()
              this.$refs.table.fetchMethod()
              this.hideModal()
            })
            .finally( () => this.loading = false )
        }
      })
    },
  },

}
</script>
