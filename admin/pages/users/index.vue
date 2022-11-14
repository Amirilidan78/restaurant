<template>
  <div>

    <section>

      <h3>Users</h3>

      <TableSimple
        _fetchUrl="/api/admin/users/index"
        :_heads="[ 'First name', 'Last name', 'Phone','Email', 'Created at' ]"
      >
        <template v-slot="{items}">
          <tr v-for="item in items">
            <td>{{ item.first_name }}</td>
            <td>{{ item.last_name }}</td>
            <td>{{ item.phone }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.created_at }}</td>
          </tr>
        </template>
      </TableSimple>

    </section>

  </div>
</template>

<script>
export default {

  layout: "admin",

  middleware: ['auth'],

  data() {
    return {

    }
  },

  created() {

  },

  methods: {


  },

}
</script>
