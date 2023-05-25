<template>
  <main role="main" class="main-content">
    <div class="container-fluid">
      <div v-if="loading">
        <div><loadingPage /></div>
      </div>
      <h2 class="h5 page-title pb-5">إرسال إشعار جديد</h2>

      <form @submit.prevent="saveForm()">
        <div class="card shadow mb-4">
          <div class="card-header">
            <strong class="card-title">إرسال إشعار جديد</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 align-self-center">
                <div class="form-group mb-3">
                  <label for="title">العنوان</label>
                  <input
                    type="text"
                    id="title"
                    class="form-control"
                    v-model="form.title"
                  />
                  <span class="text-danger" v-if="errors.title">{{
                    errors.title[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="body">الوصف</label>
                  <input type="text" id="body" class="form-control" v-model="form.body" />
                  <span class="text-danger" v-if="errors.body">{{ errors.body[0] }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="image">الصورة</label>
                  <input
                    type="file"
                    id="image"
                    class="form-control"
                    ref="file"
                    @change="selectFile()"
                  />
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
                  إرسال
                </button>
              </div>
              <!-- /.col -->
              <div class="disableOnMobile col-md-6">
                <img src="@/assets/animations/noti.gif" alt="" />
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
  name: "noti",
  components: { loadingPage },
  data() {
    return {
      form: {
        title: "",
        body: "",
        noti_image: "",
      },
      errors: [],
      loading: false,
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
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      toastMixin.fire({
        animation: true,
        title: "تم إرسال الإشعار بنجاح",
      });
    },
    async saveForm() {
      this.loading = true;
      await axios
        .post(`/api/dash/push`, this.form, {
          headers: {
            Accept: "application/json",
            "Content-Type": "multipart/form-data",
          },
        })
        .then(() => {
          (this.form.title = ""),
            (this.form.body = ""),
            (this.$refs.file.value = null),
            (this.errors = []);
          this.alert();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.loading = false;
    },

    selectFile() {
      this.form.noti_image = this.$refs.file.files[0];
    },
  },
};
</script>

<style></style>
