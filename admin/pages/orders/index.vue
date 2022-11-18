<template>
  <div>

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2">سفارش </span>
      </template>
      <template v-slot:body>
        <div class="w-100" >

          <SelectSingle
            _label="وضعیت"
            _placeholder="وضعیت را انتخاب کنید"
            :_options="states"
            :updateHook="( val ) => order.state = val "
            :_default_value="findState(order.state) ? { id : order.state ,name : findState(order.state).name } : {}"
          />

          <InputSolid
            _label="توضیحات ادمین"
            _placeholder="توضیحات ادمین را وارد کنید"
            :updateHook="val => order.admin_comment = val"
            :_default_value="order.admin_comment"
          />

          <div class="separator my-5"></div>

          <InputSolid
            _label="آدرس کاربر"
            :_disabled="true"
            :_default_value="order.user.address"
          />

          <InputSolid
            _label="شماره همراه کاربر"
            :_disabled="true"
            :_default_value="order.user.phone"
          />

          <InputSolid
            _label="شماره ثابت کاربر"
            :_disabled="true"
            :_default_value="order.user.mobile"
          />

          <InputSolid
            _label="آدرس کاربر"
            _placeholder="آدرس کاربر"
            :_disabled="true"
            :_default_value="order.user.address"
          />

        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-center">
          <button class="btn btn-sm btn-primary w-100 float-end" @click="updateMeal">ویرایش</button>
        </div>
      </template>
    </ModalCenter>

    <div class="row mt-5 ">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">سفارش ها</h3>
          </div>
          <div class="card-body">
            <TableSimple
              ref="table"
              _fetchUrl="/api/admin/orders/index"
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
                  <td>
                    <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showModal(item)">نمایش</span>
                  </td>
                </tr>
              </template>
            </TableSimple>
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

  data() {
    return {
      modal: false,
      order: {},
      states: [
        {
          id: "pending" ,
          name: "در انتظار پرداخت" ,
        },
        {
          id: "payed" ,
          name: "پرداخت شده" ,
        },
        {
          id: "cancelled" ,
          name: "لغو شده از طرف مشتری" ,
        },
        {
          id: "ready" ,
          name: "آماده تحویل" ,
        },
        {
          id: "delivered" ,
          name: "تحویل داده شده" ,
        },
        {
          id: "rejected" ,
          name: "لغو شده از طرف ادمین" ,
        },
      ]
    }
  },

  created() {},

  methods: {

    findState(state_name) {
      return this.states.find( item => item.id === state_name )
    },

    hideModal(){
      this.modal = false
    },

    showModal(order){
      this.modal = true
      this.order = order
    },

    updateMeal(){

    }

  },

}
</script>
