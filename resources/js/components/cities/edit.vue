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
                        <strong class="card-title">تعديل المدينة</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">الاسم بالعربية</label>
                                    <input type="text" id="simpleinput" class="form-control" v-model="form.name_ar" />
                                    <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name-en">الاسم بالإنجليزية</label>
                                    <v-select v-model="form.name_en" id="name-en" label="name_en" :options="cities"
                                        :searchable="true" />
                                    <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-email">سعر الشحن</label>
                                    <input type="text" id="example-email" name="example-email" class="form-control"
                                        v-model="form.price" />
                                    <span class="text-danger" v-if="errors.price">{{
                                        errors.price[0]
                                    }}</span>
                                </div>
                                <button type="submit" class="btn"
                                    style="background-color: #91b307;color: aliceblue;width: 100px;font-weight: 600;">
                                    تأكيد
                                </button>
                            </div>
                            <!-- /.col -->
                            <div class="disableOnMobile col-md-6">
                                <img src="@/assets/animations/Navigation.gif" alt="" />
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    name: "edit_city",
    components: { loadingPage, vSelect },
    data() {
        return {
            loading: false,
            form: {
                name_ar: "",
                name_en: "",
                price: "",
            },
            errors: [],
            id: this.$route.params.id,
            cities: [],
        };
    },
    mounted() {
        this.city();
        this.fetchAramexCities();
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
                title: "تم تعديل المدينة بنجاح",
            });
        },
        async city() {
            this.loading = true;
            await axios
                .get(`/api/dash/city/show/${this.id}`)
                .then((res) => {
                    this.form = res.data.city;
                })
                .catch(() => {
                    this.$router.push({ name: "error404" });
                });
            this.loading = false;
        },
        async saveForm() {
            this.loading = true;
            await axios
                .post(`/api/dash/city/edit/${this.id}`, {
                    name: this.form.name_ar,
                    name_en: this.form.name_en,
                    price: this.form.price,
                })
                .then(() => {
                    this.city();
                    this.alert();
                    this.errors = [];
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
            this.loading = false;
        },

        async fetchAramexCities() {
            this.loading = true;
            await axios.get(`/api/dash/fetchAramexCities`).then((res) => {
                this.cities = res.data.Cities.string;
            }).catch((err) => {
                console.log(err);
            })
            this.loading = false;
        }
    },
};
</script>

<style></style>
