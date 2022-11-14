<template>
  <div v-if="!loading">

    <section>

      <h3>Meals</h3>

      <TableSimple
        _fetchUrl="/api/admin/meals/index"
        :_heads="[ 'Name', 'Price' ]"
      >
        <template v-slot="{items}">
          <tr v-for="item in items">
            <td>{{ item.name }}</td>
            <td>{{ item.price_string }} Toman</td>
            <td> <button @click="() => deleteMeal(item.id)">delete</button> </td>
          </tr>
        </template>
      </TableSimple>

    </section>

    <section>

      <h3>Add meal</h3>

      <div>
        <label for="name">Name</label>
        <input type="text" v-model="meal.name">
      </div>

      <div>
        <label for="description">Description</label>
        <input type="text" v-model="meal.description">
      </div>

      <div>
        <label for="images">Images</label>
        <input name="images[]" type="text" v-model="meal.images">
      </div>

      <div>
        <label for="price">Price</label>
        <input type="text" v-model="meal.price">
      </div>

      <button @click="storeMeal">Submit</button>

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
      meal: {},
    }
  },

  created() {

  },

  methods: {

    storeMeal(){
      this.loading = true
      this.$axios.post("/api/admin/meals/store",this.meal)
        .then( () => {
          this.$swal_success()
          this.meal = {}
        })
        .finally( () => this.loading = false )
    },

    deleteMeal(id){
      this.loading = true
      this.$axios.post(`/api/admin/meals/delete/${id}`)
        .then( () => this.$swal_success() )
        .finally( () => this.loading = false )
    },
  },

}
</script>
