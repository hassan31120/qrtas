<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">إضافة عضو جديد</h2>

      <form @submit.prevent="saveForm">
        <div class="card shadow mb-4">
          <div class="card-header">
            <strong class="card-title">إضافة عضو جديد</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 align-self-center">
                <div class="form-group mb-3">
                  <label for="simpleinput">الإسم</label>
                  <input
                    type="text"
                    id="simpleinput"
                    class="form-control"
                    v-model="form.name"
                  />
                  <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="example-email">الإيميل</label>
                  <input
                    type="email"
                    id="example-email"
                    name="example-email"
                    class="form-control"
                    v-model="form.email"
                  />
                  <span class="text-danger" v-if="errors.email">{{
                    errors.email[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="simpleinput">رقم الهاتف</label>
                  <input
                    type="text"
                    id="simpleinput"
                    class="form-control"
                    v-model="form.number"
                  />
                  <span class="text-danger" v-if="errors.number">{{
                    errors.number[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="example-password">الرقم السري</label>
                  <input
                    type="password"
                    id="example-password"
                    class="form-control"
                    v-model="form.password"
                  />
                  <span class="text-danger" v-if="errors.password">{{
                    errors.password[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="example-palaceholder">تأكيد الرقم السري</label>
                  <input
                    type="password"
                    id="example-palaceholder"
                    class="form-control"
                    v-model="form.password_confirmation"
                  />
                  <span class="text-danger" v-if="errors.password_confirmation">{{
                    errors.password_confirmation[0]
                  }}</span>
                </div>
                <button
                  type="submit"
                  class="btn"
                  style="
                    background-color: #a1484d;
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
                <img src="@/assets/animations/signUp.gif" alt="" />
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
  name: "add_user",
  components: { loadingPage },
  data() {
    return {
      loading: false,
      form: {
        name: "",
        email: "",
        number: "",
        password: "",
        password_confirmation: "",
      },
      errors: [],
    };
  },
  mounted() {},
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
        title: "تم إضافة العضو بنجاح",
      });
    },
    async saveForm() {
      this.loading = true;
      await axios
        .post(`api/dash/user/add`, this.form)
        .then(() => {
          this.$router.push({ name: "users" });
          this.alert();
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
