<template>
    <main role="main" class="main-content">
        <div v-if="loading">
            <div>
                <loadingPage />
            </div>
        </div>
        <div class="container-fluid">
            <form @submit.prevent="saveForm">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">إضافة مقال جديد</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">العنوان</label>
                                    <input type="text" id="simpleinput" class="form-control" v-model="this.form.title" />
                                    <span class="text-danger" v-if="errors.title">{{
                                        errors.title[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-email">الصورة</label>
                                    <input type="file" id="example-email" name="example-email" class="form-control"
                                        ref="file" @change="selectFile" />
                                    <span class="text-danger" v-if="errors.image">{{
                                        errors.image[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3" style="direction: ltr !important">
                                    <label for="example-email">المقال</label>
                                    <QuillEditor theme="snow" v-model:content="form.desc" content-type="html"
                                        toolbar="full" />
                                    <span class="text-danger" v-if="errors.desc">{{ errors.desc[0] }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-email">البانر</label>
                                    <input type="file" id="example-email" name="example-email" class="form-control"
                                        ref="banner" @change="selectBanner" />
                                    <span class="text-danger" v-if="errors.banner">{{
                                        errors.banner[0]
                                    }}</span>
                                </div>
                                <button type="submit" class="btn"
                                    style="background-color: #91b307;color: aliceblue;width: 100px;font-weight: 600;">
                                    تأكيد
                                </button>
                            </div>
                            <!-- /.col -->
                            <div class="disableOnMobile col-md-6 align-self-center">
                                <img src="@/assets/animations/Product_iteration.gif" alt="..." />
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
    name: "add_article",
    components: { loadingPage },
    data() {
        return {
            loading: false,
            form: {
                title: "",
                image: "",
                banner: "",
                desc: "",
            },
            errors: [],
        };
    },
    mounted() { },
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
                title: "تم إضافة المقال بنجاح",
            });
        },
        async saveForm() {
            this.loading = true;
            await axios
                .post(`api/dash/article/add`, this.form, {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    (this.form.name = ""), (this.form.image = ""), (this.$refs.file.value = null);
                    this.$router.push({ name: "articles" });
                    this.alert();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
            this.loading = false;
        },

        selectFile() {
            this.form.image = this.$refs.file.files[0];
        },

        selectBanner() {
            this.form.banner = this.$refs.banner.files[0];
        },
    },
};
</script>

<style></style>
