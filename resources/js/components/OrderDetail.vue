<template>
  <div class="container my-5" v-if="order">
    <div v-if="success.msg" class="alert alert-success" role="alert">
      {{ success.msg }}
    </div>
    <div class="mb-3">
      <h3>Почта</h3>
      <input v-model="client_email" type="email" class="form-control">
      <div v-if="errors.client_email" class="text-danger">
        {{ errors.client_email }}
      </div>
    </div>
    <h3>Партнер</h3>
    <select v-model="partner" class="form-select my-3" aria-label="Партнер">
      <option v-for="item in partners" :key="item.id" :value="item.id"
              :selected="item.id === partner.id"
      >{{ item.name }}
      </option>
    </select>
    <div v-if="errors.partner" class="text-danger">
      {{ errors.partner }}
    </div>


    <div class="my-3">
      <h3>Товары</h3>
      <table class="table table-borderless">
        <thead>
        <tr>
          <th scope="col">Название</th>
          <th scope="col">Количество</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="prod in order.products">
          <td>{{ prod.name }}</td>
          <td>{{ prod.pivot.quantity }}</td>
        </tr>

        </tbody>

      </table>

    </div>

    <div class="row my-3">
      <div class="col-6"><h3>Cтатус заказа: </h3></div>
      <div class="col-6">
        <select v-model="status" class="form-select">
          <option v-for="item in status_types"
                  :key="item.code"
                  :value="item.code"
                  :selected="item.code === order.status"
          >{{ item.name }}
          </option>
        </select>
      </div>
    </div>
    <div class="text-danger">
      {{ errors.status }}
    </div>

    <h3 class="my-3">Стоимость: {{ price }}</h3>

    <div class="d-flex">
      <button @click.prevent="update" class="btn-success btn my-3">Обновить</button>
      <a href="/orders" class="btn-primary btn m-3">Вернуться</a>
    </div>


  </div>

</template>

<script>
export default {
  name: "OrderDetail",
  data: () => ({
    client_email: '',
    partner: '',
    order_products: [],
    status: '',
    errors: [],
    success: false
  }),
  computed: {
    price() {
      let total = 0;
      for (let prod of this.order.products) {
        total += prod.price * prod.pivot.quantity
      }
      return total;
    }
  },
  props: {
    order: {
      required: true,
    },
    products: {
      required: true,
    },
    partners: {
      required: true,
    },
    status_types: {
      required: true,
    }
  },
  mounted() {
    this.client_email = this.order.client_email
    this.partner = this.order.partner.id
    this.status = this.order.status
  },
  methods: {
    update() {

      let payload = {
        client_email: this.client_email,
        partner_id: this.partner,
        status: this.status
      }
      let t = this

      axios.post('/api/order/' + this.order.id, payload)
          .then(function (res) {
            console.log(res.data.msg)
            t.success = res.data
            setTimeout(() => {
              t.success = []
            }, 5000)
          })
          .catch(function (err) {
            t.errors = err.response.data.errors
          })

    }
  }

}
</script>

<style scoped>

</style>
