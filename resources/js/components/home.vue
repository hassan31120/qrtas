<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="h5 page-title mt-3">مرحبا {{ user.name }} !</h2>
          <p class="text-muted">مرحبا بك في لوحة التحكم الخاصة ب lacabina</p>
          <div class="row top_cards">
            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'admins' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.admins }}</span>
                        <p class="small text-muted mb-2">عدد المسؤولين</p>
                      </div>
                      <div class="col-auto">
                        <span class="fe fe-32 fe-user-check text-hassan mb-0"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>
            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'users' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.users }}</span>
                        <p class="small text-muted mb-2">عدد الأعضاء</p>
                      </div>
                      <div class="col-auto">
                        <span class="fe fe-32 fe-users text-hassan mb-0"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>

            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'cities' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.cities }}</span>
                        <p class="small text-muted mb-2">عدد المدن</p>
                      </div>
                      <div class="col-auto">
                        <span class="fe fe-32 fe-globe text-hassan mb-0"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>
          </div>

          <div class="row top_cards">
            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'cats' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.cats }}</span>
                        <p class="small text-muted mb-2">عدد الأقسام الرئيسية</p>
                      </div>
                      <div class="col-auto">
                        <span class="fe fe-32 fe-tag text-hassan mb-0"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>

            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'products' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.products }}</span>
                        <p class="small text-muted mb-2">عدد المنتجات</p>
                      </div>
                      <div class="col-auto">
                        <span class="fe fe-32 fe-layers text-hassan mb-0"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>

            <div class="col-md-4 mb-4">
              <router-link :to="{ name: 'orders' }">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <span class="h2 mb-0">{{ data.orders }}</span>
                        <p class="small text-muted mb-2">عدد الطلبات</p>
                      </div>
                      <div class="col-auto">
                        <span
                          class="fe fe-32 fe-git-pull-request text-hassan mb-0"
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </router-link>
            </div>
          </div>

          <h2 class="h5">آخر المنتجات والطلبات</h2>
          <p class="text-muted">عرض مختصر لآخر المنتجات والطلبات</p>
          <div class="row">
            <!-- Recent Activity -->
            <div class="col-md-6 mb-4">
              <div class="card shadow">
                <div class="card-header bg-hassan">
                  <strong class="card-title">آخر المنتجات</strong>
                  <router-link
                    class="float-right small text-muted"
                    :to="{ name: 'products' }"
                    >عرض الكل
                  </router-link>
                </div>
                <div class="card-body">
                  <div class="list-group list-group-flush my-n3">
                    <div
                      class="list-group-item"
                      v-for="product in data.latestProducts"
                      :key="product.id"
                    >
                      <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                          <img
                            :src="product.images[0]"
                            alt="..."
                            class="rounded-circle"
                            width="60"
                            height="60"
                          />
                        </div>
                        <div class="col">
                          <strong>{{ product.name }}</strong>
                          <div class="my-0 text-muted small">
                            سعر المنتج : {{ product.new_price }}
                          </div>
                        </div>
                        <div class="col-auto">
                          <strong>{{ product.amount }}</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / .list-group -->
                </div>
                <!-- / .card-body -->
              </div>
              <!-- / .card -->
            </div>
            <div class="col-md-6 mb-4">
              <div class="card shadow">
                <div class="card-header bg-hassan">
                  <strong class="card-title">آخر الطلبات</strong>
                  <router-link
                    class="float-right small text-muted"
                    :to="{ name: 'orders' }"
                    >عرض الكل
                  </router-link>
                </div>
                <div class="card-body">
                  <div class="list-group list-group-flush my-n3">
                    <div
                      class="list-group-item"
                      v-for="order in data.latestOrders"
                      :key="order.id"
                    >
                      <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                          <img
                            :src="order.image"
                            alt="..."
                            class="rounded-circle"
                            width="60"
                            height="60"
                          />
                        </div>
                        <div class="col">
                          <strong>{{ order.name }}</strong>
                          <div class="my-0 text-muted small">
                            البريد الإلكتروني : {{ order.email }}
                          </div>
                          <div class="my-0 text-muted small">
                            الهاتف : {{ order.number }}
                          </div>
                        </div>
                        <div class="col-auto">
                          <strong>{{ order.grandTotal }}</strong>
                          <div>
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / .list-group -->
                </div>
                <!-- / .card-body -->
              </div>
              <!-- / .card -->
            </div>
          </div>
          <!-- / .row -->
        </div>
      </div>
      <!-- .row -->
    </div>
    <footer>
      <p class="text-center">كل الحقوق محفوظة</p>
    </footer>
  </main>
</template>

<script>
import loadingPage from "./layouts/laoding.vue";

export default {
  name: "home",
  components: { loadingPage },
  data() {
    return { user: {}, data: {}, loading: false };
  },
  mounted() {
    this.getUser();
    this.getData();
  },
  methods: {
    async getUser() {
      this.loading = true;
      await axios
        .get(`api/user`)
        .then((res) => {
          this.user = res.data;
        })
        .catch(() => {
          this.$router.push({ name: "login" });
        });
      this.loading = false;
    },
    async getData() {
      this.loading = true;
      await axios
        .get(`/api/dash/data`)
        .then((res) => {
          this.data = res.data;
        })
        .catch(() => {
          this.$router.push({ name: "login" });
        });
      this.loading = false;
    },
  },
};
</script>

<style></style>
