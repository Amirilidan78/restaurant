<template>
  <div>
    <div class="row">

      <template v-if="!loading_daily" v-for="(item,date) of daily_records">
        <div class="col-md-3 mt-3" >
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">
                <span>سفارش های</span>
                <span class="mx-2">{{ date }}</span>
              </h6>
            </div>
            <div class="card-body">
              <template v-if="!item.meal && !item.products">
                <div class="row">
                  <div class="col-12 d-flex justify-content-center align-items-center min-h-200px">
                    هیچ سفارشی یافت نشد
                  </div>
                </div>
              </template>
              <template v-else >
                <div class="row">
                  <div class="col-12 min-h-200px">
                    <table class="table table-striped table-hover table-row-bordered rounded border text-nowrap gx-3 gy-3">
                      <tbody>
                        <tr v-if="item.meal">
                          <th>{{ item.meal.name }}</th>
                          <td>{{ item.meal.quantity }}</td>
                        </tr>
                        <template v-if="item.products" v-for="(product,index) of item.products">
                          <tr>
                            <th>{{ product.name }}</th>
                            <td>{{ product.quantity }}</td>
                          </tr>
                        </template>
                      </tbody>
                    </table>
                    <div class="col-12 text-center">
                      <button class="btn btn-sm btn-primary" @click="() => changeTableDate(date)">نمایش سفارش ها</button>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </template>

      <div class="col-md-6 mt-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <span>سفارش های</span>
              <span class="mx-2">{{ daily_date ? daily_date : "امروز" }}</span>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <TableSimple
                  ref="table"
                  :_fetchUrl="`/api/admin/get-daily-orders/${daily_date}`"
                  :_heads="[ 'کاربر', 'نوع سفارش', 'تاریخ', 'قیمت کل', 'بسته بندی', 'نحوه تحویل', 'وضعیت' ]"
                >
                  <template v-slot="{items}">
                    <tr v-for="item in items">
                      <td>{{ item.user.first_name }} {{ item.user.last_name }}</td>
                      <td>{{ item.type_text }}</td>
                      <td>{{ item.date_jalali }}</td>
                      <td> <b>{{ item.total_price_string }}</b> تومان </td>
                      <td>{{ item.packing_type_text }}</td>
                      <td>{{ item.delivery_type_text }}</td>
                      <td>{{ item.state_text }}</td>
                    </tr>
                  </template>
                </TableSimple>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mt-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">آخرین سفارش ها</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <TableSimple
                  ref="table"
                  :_fetchUrl="`/api/admin/get-latest-orders`"
                  :_heads="[ 'کاربر', 'نوع سفارش', 'تاریخ', 'قیمت کل', 'بسته بندی', 'نحوه تحویل', 'وضعیت' ]"
                >
                  <template v-slot="{items}">
                    <tr v-for="item in items">
                      <td>{{ item.user.first_name }} {{ item.user.last_name }}</td>
                      <td>{{ item.type_text }}</td>
                      <td>{{ item.date_jalali }}</td>
                      <td> <b>{{ item.total_price_string }}</b> تومان </td>
                      <td>{{ item.packing_type_text }}</td>
                      <td>{{ item.delivery_type_text }}</td>
                      <td>{{ item.state_text }}</td>
                    </tr>
                  </template>
                </TableSimple>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {

  layout: "admin",

  middleware: ['auth'],

  data(){
    return {
      loading_daily: true ,
      daily_date: "" ,
      daily_records : [] ,
    }
  },

  created() {
    this.getDailyMealsAndProducts()
  },

  methods: {

    getDailyMealsAndProducts(){
      this.loading_daily = true
      this.$axios.$get("/api/admin/get-daily-meals-and-products")
        .then( ({data}) => this.daily_records = data )
        .finally( () => this.loading_daily = false )
    },

    changeTableDate(date) {
      this.daily_date = date
      this.$refs.table.fetchMethod()
    }

  }

}
</script>
