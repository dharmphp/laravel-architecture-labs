<template>
  <div class="panel panel-default">
    <div class="panel-heading">Live Orders (Vue 2 Component)</div>
    <div class="panel-body">
      <input v-model="filter" placeholder="Search orders..." class="form-control" />
      <table class="table table-striped" style="margin-top: 10px;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in filteredOrders" :key="order.id">
            <td>#{{ order.id }}</td>
            <td>{{ order.customer_name }}</td>
            <td>₹{{ order.amount }}</td>
            <td><span class="label label-success">{{ order.status }}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: '',
      orders: []
    }
  },
  computed: {
    filteredOrders() {
      return this.orders.filter(o => o.customer_name.toLowerCase().includes(this.filter.toLowerCase()));
    }
  },
  mounted() {
    this.fetchOrders();
  },
  methods: {
    fetchOrders() {
      axios.get('/api/orders').then(res => { this.orders = res.data; });
    }
  }
}
</script>
