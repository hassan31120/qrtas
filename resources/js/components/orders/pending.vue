<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">كل الطلبات المعلقة</h2>

      <table class="table mt-5 table-hover">
        <thead style="background-color: #a1484d">
          <tr>
            <th scope="col">#</th>
            <th scope="col">الإسم</th>
            <th scope="col">البريد الالكتروني</th>
            <th scope="col">الرقم</th>
            <th scope="col">حالة الطلب</th>
            <th scope="col">السعر</th>
            <th scope="col">تفاصيل الطلب</th>
            <th scope="col">منذ</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(order, index) in orders" :key="order.id">
            <td scope="row">{{ index + 1 }}</td>
            <td>{{ order.name }}</td>
            <td>{{ order.email }}</td>
            <td>{{ order.number }}</td>
            <td>
              <span
                v-if="order.status == 'Pending'"
                class="badge badge-pill badge-warning"
                >{{ order.status }}</span
              >
              <span
                v-if="order.status == 'Accepted'"
                class="badge badge-pill badge-success"
                >{{ order.status }}</span
              >
              <span
                v-if="order.status == 'Declined'"
                class="badge badge-pill badge-danger"
                >{{ order.status }}</span
              >
            </td>
            <td>{{ order.grandTotal }}</td>
            <td>
              <router-link :to="{ name: 'order', params: { id: order.id } }"
                ><button class="btn btn-hassan">عرض التفاصيل</button>
              </router-link>
            </td>
            <td>{{ order.created_at }}</td>
            <td>
              <button
                type="button"
                @click="accept(order.id)"
                class="btn btn-success mr-2"
              >
                قبول
              </button>
              <button type="button" @click="decline(order.id)" class="btn btn-danger">
                رفض
              </button>
            </td>
            <td class="actions">
              <button type="button" @click="delCat(order.id)">
                <i class="fe fe-trash fe-16"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- pagination -->
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
          <li
            class="page-item"
            v-for="link in pagination.links"
            :key="link"
            v-bind:class="[{ disabled: !link.url }, { haha: link.active }]"
          >
            <a
              class="page-link"
              href="#"
              v-html="link.label"
              @click="fetchorders(link.url)"
            ></a>
          </li>
        </ul>
      </nav>
    </div>
  </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";
import axios from "axios";

export default {
  name: "pending",
  components: { loadingPage },
  data() {
    return {
      orders: [],
      loading: false,
      pagination: {},
    };
  },
  mounted() {
    this.fetchorders();
  },
  methods: {
    delCat(id) {
      this.$swal
        .fire({
          title: "هل انت متأكد؟",
          text: "لن تتمكن من إعادة هذه الخطوة!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "نعم إحذف",
          cancelButtonText: "الغاء",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios.post(`/api/dash/order/destroy/${id}`);
            this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
            this.fetchorders();
          }
        });
    },

    async fetchorders(page_url) {
      this.loading = true;
      page_url = page_url || `api/dash/orders/pending`;
      await axios
        .get(page_url)
        .then((res) => {
          this.orders = res.data.data;
          this.makePagination(res.data.meta);
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
      this.loading = false;
    },

    successalert() {
      var toastMixin = this.$swal.mixin({
        toast: true,
        icon: "success",
        title: "General Title",
        animation: false,
        position: "top-right",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      toastMixin.fire({
        animation: true,
        title: "تم قبول الطلب بنجاح",
      });
    },

    async accept(id) {
      this.loading = true;
      await axios
        .post(`/api/dash/changeStatus/${id}`, { status: "Accepted" })
        .then(this.successalert(), this.fetchorders());
      this.loading = false;
    },

    declinealert() {
      var toastMixin = this.$swal.mixin({
        toast: true,
        icon: "success",
        title: "General Title",
        animation: false,
        position: "top-right",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      toastMixin.fire({
        animation: true,
        title: "تم رفض الطلب بنجاح",
      });
    },

    async decline(id) {
      this.loading = true;
      await axios
        .post(`/api/dash/changeStatus/${id}`, { status: "Declined" })
        .then(this.declinealert(), this.fetchorders());
      this.loading = false;
    },

    async makePagination(meta) {
      let pagination = {
        links: meta.links,
      };
      this.pagination = pagination;
    },
  },
};
</script>

<style></style>
