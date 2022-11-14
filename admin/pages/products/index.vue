<template>
  <div v-if="!loading">

    <section>

      <h3>Products</h3>

      <TableSimple
        _fetchUrl="/api/admin/products/index"
        :_heads="[ 'Name', 'Price', 'Stock']"
      >
        <template v-slot="{items}">
          <tr v-for="item in items">
            <td>{{ item.name }}</td>
            <td>{{ item.price_string }} Toman</td>
            <td>{{ item.stock }}</td>
            <td> <button @click="() => deleteProduct(item.id)">delete</button> </td>
          </tr>
        </template>
      </TableSimple>

    </section>

    <section>

      <h3>Add product</h3>

      <div>
        <label for="name">Name</label>
        <input type="text" v-model="product.name">
      </div>

      <div>
        <label for="description">Description</label>
        <input type="text" v-model="product.description">
      </div>

      <div>
        <label for="images">Images</label>
        <input name="images[]" type="text" v-model="product.images">
      </div>

      <div>
        <label for="price">Price</label>
        <input type="text" v-model="product.price">
      </div>

      <div>
        <label for="stock">Stock</label>
        <input type="text" v-model="product.stock">
      </div>

      <button @click="storeProduct">Submit</button>

    </section>

  </div>
</template>

<script>
export default {

  layout: "admin",

  middleware: ['auth'],

  data() {
    return {
      loading: false ,
      product: {},
    }
  },

  created() {

  },

  methods: {

    storeProduct(){
      this.loading = true
      this.$axios.post("/api/admin/products/store",this.product)
        .then( () => {
          this.$swal_success()
          this.product = {}
        })
        .finally( () => this.loading = false )
    },

    deleteProduct(id){
      this.loading = true
      this.$axios.post(`/api/admin/products/delete/${id}`)
        .then( () => this.$swal_success() )
        .finally( () => this.loading = false )
    },
  },

}
</script>
