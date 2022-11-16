<template>
  <div>

    <ModalCenter :_show="modal" :_dismissHook="hideModal" _size="md">
      <template v-slot:header>
        <span class="px-2" v-if="editing">ویرایش محصول</span>
        <span class="px-2" v-else>ایجاد محصول جدید</span>
      </template>
      <template v-slot:body>
        <div class="w-100" >
          <LoadingSimple h="200" v-if="modal_loading" />
          <div v-else class="row">
            <div class="col-lg-9">

              <InputSolid
                _label="نام"
                _placeholder="نام را وارد کنید"
                :updateHook="val => product.name = val"
                :_default_value="product.name"
              />

              <InputSolid
                _label="توضیحات"
                _placeholder="توضیحات را وارد کنید"
                :updateHook="val => product.description = val"
                :_default_value="product.description"
              />

              <InputSolid
                _label="قیمت به تومان"
                _placeholder="قیمت را وارد کنید"
                :updateHook="val => product.price = val"
                :_default_value="product.price"
                _type="number"
              />

              <InputSolid
                _label="موجودی"
                _placeholder="موجودی را وارد کنید"
                :updateHook="val => product.stock = val"
                :_default_value="product.stock"
                _type="number"
              />

              <div>
                <label class="btn btn-primary w-200px" for="images" @click="() => $refs.product_image.click()">اضافه کردن عکس ها</label>
                <input name="images" ref="product_image" type="file" hidden multiple @input="changeProductImages">
                <div>
                  <template v-for="(value,key) of product.images">
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
          <button class="btn btn-sm btn-primary w-100 float-end" v-if="editing" @click="updateProduct">ویرایش</button>
          <button class="btn btn-sm btn-primary w-100 float-end" v-else @click="storeProduct">ایجاد</button>
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

    <template v-else >
      <div class="row mt-5 ">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">محصولات</h3>
              <div class="card-toolbar">
                <button class="btn btn-icon btn-active-icon-primary" @click="showModal">
                  <Icon name="plus-rounded" color="nothing" />
                </button>
              </div>
            </div>
            <div class="card-body">
              <TableSimple
                table="table"
                _fetchUrl="/api/admin/products/index"
                :_heads="[ 'نام', 'قیمت', 'عملیات ها' ]"
              >
                <template v-slot="{items}">
                  <tr v-for="item in items">
                    <td>{{ item.name }}</td>
                    <td> <b>{{ item.price_string }}</b> تومان </td>
                    <td>
                      <span class="btn btn-warning btn-sm py-1 px-2 fs-8" @click="() => showEditModal(item)" >ویرایش</span>
                      <span class="btn btn-danger btn-sm py-1 px-2 fs-8" @click="() => deleteProduct(item.id)" >حذف</span>
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
      product: {},
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
      this.product = {}
    },

    showEditModal(product){
      this.editing = true
      this.modal = true
      this.product = {...product}
    },

    changeProductImages(e){
      this.product.images = []
      this.modal_loading = true
      this.$fileListToBase64(e.target.files)
        .then( list => this.product.images = list )
        .finally( () => this.modal_loading = false )
    },

    storeProduct(){
      this.modal_loading = true
      this.$axios.post("/api/admin/products/store",this.product)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModal()
        })
        .finally( () => this.modal_loading = false )
    },

    updateProduct(){
      this.modal_loading = true
      this.$axios.post(`/api/admin/products/update/${this.product.id}`,this.product)
        .then( () => {
          this.$swal_success()
          this.$refs.table.fetchMethod()
          this.hideModal()
        })
        .finally( () => this.modal_loading = false )
    },

    deleteProduct(id){
      this.$confirmation({
        confirmed_then: () => {
          this.loading = true
          this.$axios.post(`/api/admin/products/delete/${id}`)
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
