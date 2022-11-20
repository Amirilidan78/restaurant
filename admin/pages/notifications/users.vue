<template>
  <div>

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2">پیام</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <pretty-json :data="notification" />
        </div>
      </template>
    </ModalCenter>

    <div class="row mt-5 ">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">پیام های کاربر ها</h3>
          </div>
          <div class="card-body">
            <TableSimple
              ref="table"
              _fetchUrl="/api/admin/notifications/user-index"
              :_heads="['عنوان', 'شماره همراه', 'وضعیت', 'عملیات' ]"
            >
              <template v-slot="{items}">
                <tr v-for="item in items">
                  <td>{{ item.title }}</td>
                  <td>{{ item.sms_phone }}</td>
                  <td>{{ item.sms_notified ?"موفق":"خطا" }}</td>
                  <td>
                    <span class="btn btn-primary btn-sm py-1 px-2 fs-8" @click="() => showModal(item)" >نمایش</span>
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
      notification: {},
    }
  },

  created() {},

  methods: {

    hideModal(){
      this.modal = false
    },

    showModal(notification){
      this.modal = true
      this.notification = notification
    },

  },

}
</script>
