<template>
  <div>

    <template>
      <div class="row mt-5 ">
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">وعده های غذایی ماه آینده</h3>
            </div>
            <div class="card-body">
              <template v-if="loading || meal_loading" >
                <LoadingSimple h="400"/>
              </template>
              <template v-else>
                <div class="row" >
                  <div class="col-lg-3" v-for="(meal_id,date) in nextMonthPlans" >
                    <SelectSingle
                      :_label="date"
                      _placeholder="غذا را انتخاب کنید"
                      :_options="meals"
                      :updateHook="( val ) => nextMonthPlans[date] = val "
                      :_default_value="findMeal(meal_id) ? { id : meal_id ,name : findMeal(meal_id).name } : {}"
                    />
                  </div>
                </div>
              </template>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary btn-sm" @click="updateNextMonthPlans">ویرایش</button>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">وعده های غذایی</h3>
            </div>
            <div class="card-body">
              <TableSimple
                ref="table"
                _fetchUrl="/api/admin/meal-plans/index"
                :_heads="[ 'غذا', 'تاریخ']"
              >
                <template v-slot="{items}">
                  <tr v-for="item in items">
                    <td>{{ item.meal.name }}</td>
                    <td>{{ item.date_jalali }}</td>
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
      loading: true ,
      meal_loading: true ,
      meals: [],
      nextMonthPlans: [],
    }
  },

  created() {
    this.getMeals()
    this.getNextMonthPlans()
  },

  methods: {

    findMeal(meal_id) {
      return this.meals.find( item => item.id === meal_id )
    },

    getMeals(){
      this.meal_loading = true
      this.$axios.get(`/api/admin/meals/all`)
        .then(({ data }) => this.meals = data.data)
        .finally( () => this.meal_loading = false )
    },

    getNextMonthPlans(){
      this.loading = true
      return this.$axios.get(`/api/admin/meal-plans/get-next-month-plans`)
        .then(({ data }) => this.nextMonthPlans = data.data )
        .finally( () => this.loading = false )
    },

    updateNextMonthPlans(){
      // validate
      for (const date in this.nextMonthPlans) {
        if ( !this.nextMonthPlans[date] ) {
          return  this.$swal_error(`لطفا وعده غذایی تاریخ ${date} را مشخص کنید`)
        }
      }
      this.loading = true
      return this.$axios.post(`/api/admin/meal-plans/update-next-month-plans`, {
        plans: this.nextMonthPlans
      })
        .then(() => {
          this.$swal_success()
          this.getMeals()
          this.getNextMonthPlans()
        })
        .catch((err) => this.loading = false)
    },

  },

}
</script>
