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
                        <strong class="card-title">تعديل الصورة</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="code">الكود</label>
                                    <input type="text" id="code" class="form-control" v-model="form.code" />
                                    <span class="text-danger" v-if="errors.code">{{
                                        errors.code[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="discount_percentage">نسبة الخصم</label>
                                    <input type="text" id="discount_percentage" class="form-control"
                                        v-model="form.discount_percentage" />
                                    <span class="text-danger" v-if="errors.discount_percentage">{{
                                        errors.discount_percentage[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">تاريخ البداية</label>
                                    <input type="date" id="start_date" class="form-control" v-model="form.start_date" />
                                    <span class="text-danger" v-if="errors.start_date">{{
                                        errors.start_date[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_date">تاريخ النهاية</label>
                                    <input type="date" id="end_date" class="form-control" v-model="form.end_date" />
                                    <span class="text-danger" v-if="errors.end_date">{{
                                        errors.end_date[0]
                                    }}</span>
                                </div>
                                <button type="submit" class="btn"
                                    style="background-color: #91b307;color: aliceblue;width: 100px;font-weight: 600;">
                                    تأكيد
                                </button>
                            </div>
                            <!-- /.col -->
                            <div class="disableOnMobile col-md-6">
                                <img src="@/assets/animations/Discount.gif" alt="" />
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
    name: "edit_coupon",
    components: { loadingPage },
    data() {
        return {
            loading: false,
            form: {
                code: "",
                discount_percentage: "",
                start_date: "",
                end_date: "",
            },
            errors: [],
            id: this.$route.params.id,
        };
    },
    mounted() {
        this.coupon();
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
                title: "تم تعديل كود الخصم بنجاح",
            });
        },
        async coupon() {
            this.loading = true;
            await axios
                .get(`/api/dash/coupon/show/${this.id}`)
                .then((res) => {
                    this.form = res.data;
                })
                .catch((err) => {
                    this.$router.push({ name: "error404" });
                    console.log(err)
                });
            this.loading = false;
        },
        async saveForm() {
            this.loading = true;
            await axios
                .post(
                    `/api/dash/coupon/edit/${this.id}`, this.form)
                .then(() => {
                    this.coupon();
                    this.alert();
                    this.errors = [];
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
            this.loading = false;
        },
        selectFile() {
            this.form.image = this.$refs.file.files[0];
        },
    },
};
</script>

<style></style>
