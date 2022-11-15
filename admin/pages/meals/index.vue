<template>
  <div v-if="!loading">

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2" v-if="editing">ویرایش غذا</span>
        <span class="px-2" v-else>ایجاد غدای جدید</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <LoadingSimple h="200" v-if="modal_loading" />
          <div v-else class="row">
            <div class="col-lg-9">

              <InputSolid
                _label="نام"
                _placeholder="نام را وارد کنید"
                :updateHook="val => meal.name = val"
                :_default_value="meal.name"
              />

              <InputSolid
                _label="توضیحات"
                _placeholder="توضیحات را وارد کنید"
                :updateHook="val => meal.description = val"
                :_default_value="meal.description"
              />

              <InputSolid
                _label="قیمت به تومان"
                _placeholder="قیمت را وارد کنید"
                :updateHook="val => meal.price = val"
                :_default_value="meal.price"
              />

              <div>
                <label class="btn btn-primary w-200px" for="images" @click="() => $refs.meal_image.click()">اضافه کردن عکس ها</label>
                <input name="images" ref="meal_image" type="file" hidden multiple @input="changeMealImages">
                <div>
                  <template v-for="(value,key) of meal.images">
                    <img :src="value" :alt="key" class="mx-3 my-2 h-50px">
                  </template>
                </div>
              </div>

            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer>
        <div class="w-100 text-center">
          <button class="btn btn-sm btn-primary w-100 float-end" v-if="editing" @click="updateMeal">ویرایش</button>
          <button class="btn btn-sm btn-primary w-100 float-end" v-else @click="storeMeal">ایجاد</button>
        </div>
      </template>
    </ModalCenter>

    <div class="row mt-5 ">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">غذا ها</h3>
            <div class="card-toolbar">
              <button class="btn btn-icon btn-active-icon-primary" @click="showModal">
                <Icon name="plus-rounded" color="nothing" />
              </button>
            </div>
          </div>
          <div class="card-body">
            <TableSimple
              _fetchUrl="/api/admin/meals/index"
              :_heads="[ 'نام', 'قیمت', 'عملیات ها' ]"
            >
              <template v-slot="{items}">
                <tr v-for="item in items">
                  <td>{{ item.name }}</td>
                  <td> <b>{{ item.price_string }}</b> تومان </td>
                  <td>
                    <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showEditModal(item)" >ویرایش</span>
                    <span class="btn btn-danger btn-sm py-1 px-2 fs-8" @click="() => deleteMeal(item.id)" >حذف</span>
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
      loading: false ,
      modal_loading: false ,
      modal: false,
      editing: false,
      meal: {},
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
      this.meal = {}
    },

    showEditModal(meal){
      this.editing = true
      this.modal = true
      this.meal = {...meal}
    },

    changeMealImages(e){
      this.meal.images = []
      this.modal_loading = true
      this.$fileListToBase64(e.target.files)
        .then( list => this.meal.images = list )
        .finally( () => this.modal_loading = false )
    },

    storeMeal(){
      this.loading = true
      this.$axios.post("/api/admin/meals/store",this.meal)
        .then( () => {
          this.$swal_success()
          this.hideModal()
        })
        .finally( () => this.loading = false )
    },

    updateMeal(){
      this.loading = true
      this.$axios.post(`/api/admin/meals/update/${this.meal.id}`,this.meal)
        .then( () => {
          this.$swal_success()
          this.hideModal()
        })
        .finally( () => this.loading = false )
    },

    deleteMeal(id){
      this.$confirmation({
        confirmed_then: () => {
          this.loading = true
          this.$axios.post(`/api/admin/meals/delete/${id}`)
            .then( () => this.$swal_success() )
            .finally( () => this.loading = false )
        }
      })
    },
  },

}
</script>
