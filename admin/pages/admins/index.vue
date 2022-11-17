<template>
  <div >

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2">ایجاد ادمین جدید</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <LoadingSimple h="200" v-if="modal_loading" />
          <div v-else class="row">
            <div class="col-lg-9">

              <InputSolid
                _label="نام"
                _placeholder="نام را وارد کنید"
                :updateHook="val => admin.first_name = val"
                :_default_value="admin.first_name"
              />

              <InputSolid
                _label="نام خانوادگی"
                _placeholder="نام خانوادگی را وارد کنید"
                :updateHook="val => admin.last_name = val"
                :_default_value="admin.last_name"
              />

              <InputSolid
                _label="نام کاربری"
                _placeholder="نام کاربری را وارد کنید"
                :updateHook="val => admin.username = val"
                :_default_value="admin.username"
              />

              <InputSolid
                _label="رمز عبور"
                _placeholder="رمز عبور را وارد کنید"
                :updateHook="val => admin.password = val"
                :_default_value="admin.password"
                _type="password"
              />

              <SelectSingle
                _label="نقش"
                _placeholder="نقش را انتخاب کنید"
                :_options="roles"
                :updateHook="( val ) => admin.role = val "
                :_default_value="findRole(admin.role) ? { id : admin.role ,name : findRole(admin.role).name } : {}"
              />

            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-center">
          <button class="btn btn-sm btn-primary w-100 float-end" @click="storeAdmin">ایجاد</button>
        </div>
      </template>
    </ModalCenter>

    <ModalCenter :_show="modal_edit" :_dismissHook="hideModalEdit" _size="md">
      <template v-slot:header>
        <span class="px-2">ویرایش ادمین</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <LoadingSimple h="200" v-if="modal_loading" />
          <div v-else class="row">
            <div class="col-lg-9">

              <InputSolid
                _label="نام"
                _placeholder="نام را وارد کنید"
                :updateHook="val => admin.first_name = val"
                :_default_value="admin.first_name"
              />

              <InputSolid
                _label="نام خانوادگی"
                _placeholder="نام خانوادگی را وارد کنید"
                :updateHook="val => admin.last_name = val"
                :_default_value="admin.last_name"
              />

              <InputSolid
                _label="رمز عبور"
                _placeholder="رمز عبور را وارد کنید"
                :updateHook="val => admin.password = val"
                _type="password"
              />

              <SelectSingle
                _label="نقش"
                _placeholder="نقش را انتخاب کنید"
                :_options="roles"
                :updateHook="( val ) => admin.role = val "
                :_default_value="findRole(admin.role) ? { id : admin.role ,name : findRole(admin.role).name } : {}"
              />

            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-center">
          <button class="btn btn-sm btn-primary w-100 float-end" @click="updateAdmin">ویرایش</button>
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
              <h3 class="card-title">ادمین ها</h3>
              <div class="card-toolbar">
                <button class="btn btn-icon btn-active-icon-primary" @click="showModal">
                  <Icon name="plus-rounded" color="nothing" />
                </button>
              </div>
            </div>
            <div class="card-body">
              <TableSimple
                ref="table"
                _fetchUrl="/api/admin/admins/index"
                :_heads="[ 'نام', 'نام خانوادگی', 'نام کاربری', 'نقش', 'عملیات ها' ]"
              >
                <template v-slot="{items}">
                  <tr v-for="item in items">
                    <td>{{ item.first_name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.username }}</td>
                    <td>{{ item.role_text }}</td>
                    <td>
                      <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showEditModal(item)" >ویرایش</span>
                      <span class="btn btn-danger btn-sm py-1 px-2 fs-8" @click="() => deleteAdmin(item.id)" >حذف</span>
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
      modal_edit: false,
      admin: {},
      roles: [
        {
          id: "super_admin",
          name: "ادمین",
        },
        {
          id: "manager",
          name: "منشی",
        },
        {
          id: "chef",
          name: "آشپز",
        },
      ]
    }
  },

  created() {},

  methods: {

    findRole(role_name) {
      return this.roles.find( item => item.id === role_name )
    },

    hideModal(){
      this.modal = false
    },

    showModal(){
      this.modal = true
      this.admin = {}
    },

    hideModalEdit(){
      this.modal_edit = false
    },

    showEditModal(admin){
      this.modal_edit = true
      this.admin = {...admin}
    },

    storeAdmin(){
      this.modal_loading = true
      this.$axios.post("/api/admin/admins/store",this.admin)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModal()
        })
        .finally( () => this.modal_loading = false )
    },

    updateAdmin(){
      this.modal_loading = true
      this.$axios.post(`/api/admin/admins/update/${this.admin.id}`,this.admin)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModalEdit()
        })
        .finally( () => this.modal_loading = false )
    },

    deleteAdmin(id){
      this.$confirmation({
        confirmed_then: () => {
          this.loading = true
          this.$axios.post(`/api/admin/admins/delete/${id}`)
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
