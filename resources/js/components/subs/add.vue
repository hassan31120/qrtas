<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">إضافة قسم فرعي جديد</h2>

      <form @submit.prevent="saveForm">
        <div class="card shadow mb-4">
          <div class="card-header">
            <strong class="card-title">إضافة قسم فرعي جديد</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 align-self-center">
                <div class="form-group mb-3">
                  <label for="simpleinput">الاسم بالعربية</label>
                  <input
                    type="text"
                    id="simpleinput"
                    class="form-control"
                    v-model="form.title"
                  />
                  <span class="text-danger" v-if="errors.title">{{
                    errors.title[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="example-email">الاسم بالانجليزية</label>
                  <input
                    type="text"
                    id="example-email"
                    name="example-email"
                    class="form-control"
                    v-model="form.title_en"
                  />
                  <span class="text-danger" v-if="errors.title_en">{{
                    errors.title_en[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="cat_id">القسم الرئيسي</label>
                  <select id="cat_id" class="form-control" v-model="form.cat_id">
                    <option v-for="cat in cats" :key="cat.id" :value="cat.id">
                      {{ cat.name }}
                    </option>
                  </select>
                  <span class="text-danger" v-if="errors.cat_id">{{
                    errors.cat_id[0]
                  }}</span>
                </div>
                <button
                  type="submit"
                  class="btn"
                  style="
                    background-color: #91b307;
                    color: aliceblue;
                    width: 100px;
                    font-weight: 600;
                  "
                >
                  تأكيد
                </button>
              </div>
              <!-- /.col -->
              <div class="disableOnMobile col-md-6">
                <img src="@/assets/animations/task.gif" alt="" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";

export default {
  name: "add_sub",
  components: { loadingPage },
  data() {
    return {
      loading: false,
      form: {
        title: "",
        title_en: "",
        cat_id: "",
      },
      cats: [],
      errors: [],
    };
  },
  mounted() {
    this.fetchcats();
  },
  methods: {
    alert() {
      var toastMixin = this.$swal.mixin({
        toast: true,
        icon: "success",
        title: "General Title",
        animation: false,
        position: "top-right",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      toastMixin.fire({
        animation: true,
        title: "تم إضافة القسم بنجاح",
      });
    },
    async saveForm() {
      this.loading = true;
      await axios
        .post(`/api/dash/sub/add`, this.form)
        .then(() => {
          this.$router.push({ name: "subs" });
          this.alert();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.loading = false;
    },
    async fetchcats() {
      this.loading = true;
      await axios
        .get(`api/dash/catswithoutpagination`)
        .then((res) => {
          this.cats = res.data.data;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.loading = false;
    },
  },
};
</script>

<style></style>
