<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <form @submit.prevent="saveForm">
        <div class="card shadow mb-4">
          <div class="card-header">
            <strong class="card-title">تعديل القسم</strong>
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
                    v-model="form.name"
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
                    v-model="form.name_en"
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
  name: "edit_sub",
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
      id: this.$route.params.id,
    };
  },
  mounted() {
    this.sub();
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
        title: "تم تعديل القسم بنجاح",
      });
    },
    async sub() {
      this.loading = true;
      await axios
        .get(`/api/dash/sub/show/${this.id}`)
        .then((res) => {
          this.form = res.data.sub;
        })
        .catch(() => {
          this.$router.push({ name: "error404" });
        });
      this.loading = false;
    },
    async saveForm() {
      this.loading = true;
      await axios
        .post(`/api/dash/sub/edit/${this.id}`, {
          title: this.form.name,
          title_en: this.form.name_en,
          cat_id: this.form.cat_id,
        })
        .then(() => {
          this.sub();
          this.alert();
          this.errors = [];
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.loading = false;
    },
    async fetchcats() {
      this.loading = true;
      await axios
        .get(`/api/dash/catswithoutpagination`)
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
