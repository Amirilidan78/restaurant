<template>
  <div>

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2">ویرایش کاربر</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <LoadingSimple h="200" v-if="modal_loading" />
          <div v-else class="row">
            <div class="col-lg-9">

              <InputSolid
                _label="نام"
                _placeholder="نام را وارد کنید"
                :updateHook="val => user.first_name = val"
                :_default_value="user.first_name"
              />

              <InputSolid
                _label="نام خانوادگی"
                _placeholder="نام خانوادگی را وارد کنید"
                :updateHook="val => user.last_name = val"
                :_default_value="user.last_name"
              />

              <SelectSingle
                _placeholder="جنسیت را انتخاب کنید"
                _label="جنسیت"
                :_options="gender_list"
                :updateHook="( val ) => user.gender = val "
                :_default_value="{ id : user.gender ,name : user.gender_text }"
              />

              <InputSolid
                _label="شماره همراه"
                _placeholder="شماره همراه را وارد کنید"
                :updateHook="val => user.phone = val"
                :_default_value="user.phone"
              />

              <InputSolid
                _label="آدرس"
                _placeholder="آدرس را وارد کنید"
                :updateHook="val => user.address = val"
                :_default_value="user.address"
              />

              <SelectSingle
                _placeholder="وضعیت را انتخاب کنید"
                _label="وضعیت"
                :_options="state_list"
                :updateHook="( val ) => user.state = val "
                :_default_value="{ id : user.state ,name : user.state_text }"
              />

            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-center">
          <button class="btn btn-sm btn-primary w-100 float-end" @click="updateUser">ویرایش</button>
        </div>
      </template>
    </ModalCenter>

    <template v-if="loading">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <LoadingSimple  h="400"/>
          </div>
        </div>
      </div>
    </template>

    <template v-else>
      <div class="row mt-5 ">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">کاربران</h3>
            </div>
            <div class="card-body">
              <TableSimple
                ref="table"
                _fetchUrl="/api/admin/users/index"
                :_heads="[ 'نام', 'نام خانوادگی', 'جنسیت', 'شماره همراه', 'شماره ثابت', 'وضعیت', 'عملیات' ]"
              >
                <template v-slot="{items}">
                  <tr v-for="item in items">
                    <td>{{ item.first_name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.gender_text }}</td>
                    <td>{{ item.phone }}</td>
                    <td>{{ item.mobile }}</td>
                    <td>{{ item.state_text }}</td>
                    <td>
                      <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showEditModal(item)" >ویرایش</span>
                      <span class="btn btn-danger btn-sm py-1 px-2 fs-8" @click="() => deleteUser(item.id)" >حذف</span>
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
      loading: false ,
      modal_loading: false ,
      modal: false,
      editing: false,
      user: {},
      gender_list: [
        {
          id: "male",
          name: "مرد",
        },
        {
          id: "female",
          name: "زن",
        },
      ],
      state_list: [
        {
          id: "pending",
          name: "انتظار",
        },
        {
          id: "active",
          name: "فعال",
        },
        {
          id: "suspend",
          name: "غیر فعال",
        },
      ],
    }
  },

  created() {},

  methods: {

    hideModal(){
      this.modal = false
    },

    showModal(){
      this.modal = true
      this.editing = false
      this.user = {}
    },

    showEditModal(user){
      this.editing = true
      this.modal = true
      this.user = {...user}
    },

    updateUser(){
      this.modal_loading = true
      this.$axios.post(`/api/admin/users/update/${this.user.id}`,this.user)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModal()
        })
        .finally( () => this.modal_loading = false )
    },

    deleteUser(id){
      this.$confirmation({
        confirmed_then: () => {
          this.loading = true
          this.$axios.post(`/api/admin/users/delete/${id}`)
            .then( () => {
              this.$swal_success()
              this.$refs.table.fetchMethod()
            })
            .finally( () => this.loading = false )
        }
      })
    },
  },

}
</script>
