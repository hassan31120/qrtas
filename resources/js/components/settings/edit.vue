<template>
  <main role="main" class="main-content">
    <div class="container-fluid">
      <div v-if="loading">
        <div><loadingPage /></div>
      </div>
      <form @submit.prevent="saveForm()">
        <div class="card shadow mb-4">
          <div class="card-header">
            <strong class="card-title">تعديل الإعدادات</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 align-self-center">
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="about">من نحن</label>
                  <QuillEditor
                    v-model:content="form.about_ar"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.about">{{
                    errors.about[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="terms">الشروط والأحكام</label>
                  <QuillEditor
                    v-model:content="form.terms_ar"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.terms">{{
                    errors.terms[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="privacy">سياسة الخصوصية</label>
                  <QuillEditor
                    v-model:content="form.privacy_ar"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.privacy">{{
                    errors.privacy[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="contact">تواصل معنا</label>
                  <QuillEditor
                    v-model:content="form.contact"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.contact">{{
                    errors.contact[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="terms_en">Terms</label>
                  <QuillEditor
                    v-model:content="form.terms_en"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.terms_en">{{
                    errors.terms_en[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="about_en">About us</label>
                  <QuillEditor
                    v-model:content="form.about_en"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.about_en">{{
                    errors.about_en[0]
                  }}</span>
                </div>
                <div class="form-group mb-3" style="direction: ltr !important">
                  <label for="privacy_en">Privacy</label>
                  <QuillEditor
                    v-model:content="form.privacy_en"
                    content-type="html"
                    toolbar="full"
                  />
                  <span class="text-danger" v-if="errors.privacy_en">{{
                    errors.privacy_en[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="email">البريد الالكتروني</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="form.email"
                  />
                  <span class="text-danger" v-if="errors.email">{{
                    errors.email[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="mobile">الهاتف</label>
                  <input
                    type="text"
                    class="form-control"
                    id="mobile"
                    v-model="form.mobile"
                  />
                  <span class="text-danger" v-if="errors.mobile">{{
                    errors.mobile[0]
                  }}</span>
                </div>
                <div class="form-group mb-3">
                  <label for="whatsapp">whatsapp</label>
                  <input
                    type="text"
                    class="form-control"
                    id="whatsapp"
                    v-model="form.whatsapp"
                  />
                  <span class="text-danger" v-if="errors.whatsapp">{{
                    errors.whatsapp[0]
                  }}</span>
                </div>
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
                حفظ
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</template>

<script>
export default {
  name: "edit_settings",
  data() {
    return {
      form: {
        about_ar: "",
        terms_ar: "",
        contact: "",
        privacy_ar: "",
        about_en: "",
        privacy_en: "",
        terms_en: "",
        email: "",
        mobile: "",
        whatsapp: "",
      },
      errors: [],
      loading: false,
    };
  },
  mounted() {
    this.fetchSettings();
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
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      toastMixin.fire({
        animation: true,
        title: "تم تعديل الإعدادات بنجاح",
      });
    },
    async saveForm() {
      this.loading = true;
      await axios
        .post(
          `/api/dash/setting/edit`,
          {
            terms: this.form.terms_ar,
            privacy: this.form.privacy_ar,
            about: this.form.about_ar,
            terms_en: this.form.terms_en,
            privacy_en: this.form.privacy_en,
            about_en: this.form.about_en,
            contact: this.form.contact,
            mobile: this.form.mobile,
            email: this.form.email,
            whatsapp: this.form.whatsapp,
          },
          {
            headers: {
              Accept: "application/json",
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then(() => {
          this.$router.push({ name: "about" });
          this.alert();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.loading = false;
    },

    async fetchSettings() {
      this.loading = true;
      await axios
        .get(`/api/dash/settings`)
        .then((res) => {
          this.form = res.data.settings;
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
      this.loading = false;
    },
  },
};
</script>

<style></style>
