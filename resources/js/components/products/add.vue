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
                        <strong class="card-title">إضافة منتج جديد</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="title">العنوان بالعربية</label>
                                    <input type="text" id="title" class="form-control" v-model="form.title" required />
                                    <span class="text-danger" v-if="errors.title">{{
                                        errors.title[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">الوصف بالعربية</label>
                                    <textarea id="description" cols="30" rows="7" v-model="form.description" required
                                        class="form-control"></textarea>
                                    <span class="text-danger" v-if="errors.description">{{
                                        errors.description[0]
                                    }}</span>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label for="new_price">السعر الحالي</label>
                                        <input type="text" id="new_price" class="form-control" v-model="form.new_price"
                                            required />
                                        <span class="text-danger" v-if="errors.new_price">{{
                                            errors.new_price[0]
                                        }}</span>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label for="old_price">السعر القديم</label>
                                        <input type="text" id="old_price" class="form-control" v-model="form.old_price" />
                                        <span class="text-danger" v-if="errors.old_price">{{
                                            errors.old_price[0]
                                        }}</span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="image">الصور</label>
                                    <input type="file" id="image" name="image" class="form-control" ref="image"
                                        @change="selectImage" required multiple />
                                    <span class="text-danger" v-if="errors.image">{{
                                        errors.image[0]
                                    }}</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="title_en">العنوان بالإنجليزية</label>
                                    <input type="text" id="title_en" class="form-control" v-model="form.title_en"
                                        required />
                                    <span class="text-danger" v-if="errors.title_en">{{
                                        errors.title_en[0]
                                    }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description_en">الوصف بالإنجليزية</label>
                                    <textarea id="description_en" cols="30" rows="7" v-model="form.description_en" required
                                        class="form-control"></textarea>
                                    <span class="text-danger" v-if="errors.description_en">{{
                                        errors.description_en[0]
                                    }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="amount">الكمية</label>
                                    <input type="text" id="amount" class="form-control" v-model="form.amount" required />
                                    <span class="text-danger" v-if="errors.amount">{{
                                        errors.amount[0]
                                    }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="sub_id">القسم</label>
                                    <select v-model="form.sub_id" class="form-control" id="sub_id" required>
                                        <option :value="sub.id" v-for="sub in subs" :key="sub.id">
                                            {{ sub.name }}
                                        </option>
                                    </select>
                                    <span class="text-danger" v-if="errors.sub_id">{{
                                        errors.sub_id[0]
                                    }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn" style="
                      background-color: #a1484d;
                      color: aliceblue;
                      width: 100px;
                      font-weight: 600;
                    ">
                                تأكيد
                            </button>
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
    name: "add_product",
    components: { loadingPage },
    data() {
        return {
            loading: false,
            form: {
                title: "",
                title_en: "",
                description: "",
                description_en: "",
                amount: "",
                old_price: "",
                new_price: "",
                sub_id: "",
                images: [],
            },
            errors: [],
            subs: [],
        };
    },
    mounted() {
        this.fetchSubs();
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
                title: "تم إضافة المنتج بنجاح",
            });
        },
        async saveForm() {
            this.loading = true;
            await axios
                .post(`api/dash/product/add`, this.form, {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    this.$router.push({ name: "products" });
                    this.alert();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
            this.loading = false;
        },

        async fetchSubs() {
            this.loading = true;
            await axios
                .get(`/api/dash/subswithoutpagination`)
                .then((res) => {
                    this.subs = res.data.data;
                })
                .catch(() => {
                    this.$router.push({ name: "serverErr" });
                });
            this.loading = false;
        },

        selectImage() {
            this.form.images = this.$refs.image.files;
        },
    },
};
</script>

<style></style>
