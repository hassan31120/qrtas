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
                        <strong class="card-title">تعديل بيانات الموقع</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="email">البريد الالكتروني</label>
                                    <input type="email" id="email" class="form-control" v-model="form.email" />
                                    <span class="text-danger" v-if="errors.email">{{
                                        errors.email[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="number">رقم الجوال</label>
                                    <input type="text" id="number" class="form-control" v-model="form.number" />
                                    <span class="text-danger" v-if="errors.number">{{
                                        errors.number[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="whatsapp">الواتساب</label>
                                    <input type="text" id="whatsapp" class="form-control" v-model="form.whatsapp" />
                                    <span class="text-danger" v-if="errors.whatsapp">{{
                                        errors.whatsapp[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo">اللوقو</label>
                                    <input type="file" id="logo" class="form-control" ref="file" @change="selectFile" />
                                    <span class="text-danger" v-if="errors.logo">{{
                                        errors.logo[0]
                                    }}</span>
                                    <span>
                                        <img :src="form.logo" alt="logo" width="50" height="50"
                                            style="object-fit: contain;">
                                    </span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="app_store">لينك اب ستور</label>
                                    <input type="text" id="app_store" class="form-control" v-model="form.app_store" />
                                    <span class="text-danger" v-if="errors.app_store">{{
                                        errors.app_store[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="google_play">لينك جوجل بلاي</label>
                                    <input type="text" id="google_play" class="form-control" v-model="form.google_play" />
                                    <span class="text-danger" v-if="errors.google_play">{{
                                        errors.google_play[0]
                                    }}</span>
                                </div>
                                <button type="submit" class="btn"
                                    style="background-color: #91b307;color: aliceblue;width: 100px;font-weight: 600;">
                                    تأكيد
                                </button>
                            </div>
                            <!-- /.col -->
                            <div class="disableOnMobile col-md-6">
                                <div class="form-group mb-3">
                                    <label for="address">العنوان</label>
                                    <input type="text" id="address" class="form-control" v-model="form.address" />
                                    <span class="text-danger" v-if="errors.address">{{
                                        errors.address[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="facebook">الفيسبوك</label>
                                    <input type="text" id="facebook" class="form-control" v-model="form.facebook" />
                                    <span class="text-danger" v-if="errors.facebook">{{
                                        errors.facebook[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="twitter">تويتر</label>
                                    <input type="text" id="twitter" class="form-control" v-model="form.twitter" />
                                    <span class="text-danger" v-if="errors.twitter">{{
                                        errors.twitter[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="instagram">الانستاقرام</label>
                                    <input type="text" id="instagram" class="form-control" v-model="form.instagram" />
                                    <span class="text-danger" v-if="errors.instagram">{{
                                        errors.instagram[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="snapchat">سناب شات</label>
                                    <input type="text" id="snapchat" class="form-control" v-model="form.snapchat" />
                                    <span class="text-danger" v-if="errors.snapchat">{{
                                        errors.snapchat[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="linkedin">لينكد ان</label>
                                    <input type="text" id="linkedin" class="form-control" v-model="form.linkedin" />
                                    <span class="text-danger" v-if="errors.linkedin">{{
                                        errors.linkedin[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tiktok">تيكتوك</label>
                                    <input type="text" id="tiktok" class="form-control" v-model="form.tiktok" />
                                    <span class="text-danger" v-if="errors.tiktok">{{
                                        errors.tiktok[0]
                                    }}</span>
                                </div>
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
import axios from "axios";

export default {
    name: "edit_link",
    components: { loadingPage },
    data() {
        return {
            link: {},
            loading: false,
            form: {
                email: "",
                number: "",
                whatsapp: "",
                logo: "",
                app_store: "",
                google_play: "",
                address: "",
                facebook: "",
                twitter: "",
                instagram: "",
                linkedin: "",
                tiktok: "",
                snapchat: "",
            },
            errors: [],
        };
    },
    mounted() {
        this.fetchlink();
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
                title: "تم تعديل بيانات الموقع بنجاح",
            });
        },
        async fetchlink() {
            this.loading = true;
            await axios
                .get(`/api/dash/link`)
                .then((res) => {
                    this.form = res.data.data;
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
                    `/api/dash/link/edit`, this.form, {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    this.fetchlink();
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
            this.form.logo = this.$refs.file.files[0];
        },
    },
};
</script>

<style></style>
