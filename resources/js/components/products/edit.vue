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
                        <strong class="card-title">تعديل المنتج </strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="form-group mb-3">
                                    <label for="title">العنوان بالعربية</label>
                                    <input type="text" id="title" class="form-control" v-model="form.name" required />
                                    <span class="text-danger" v-if="errors.title">{{
                                        errors.title[0]
                                    }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">الوصف بالعربية</label>
                                    <textarea id="description" cols="30" rows="7" v-model="form.desc" required
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
                                        @change="selectImage" multiple />
                                    <span v-for="image in form.allimages" :key="image"
                                        style="width: 100px; height: 62px: position: relative;" class="delImage mt-2">
                                        <img class="ml-2 mt-2" :src="image.image" alt="image" width="100" height="62" />
                                        <button type="button" class="mt-2" @click="delImage(image.id)">
                                            <i class="fe fe-x-square fe-16 text-danger"></i>
                                        </button>
                                    </span>
                                    <span class="text-danger" v-if="errors.image">{{
                                        errors.image[0]
                                    }}</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_en">العنوان بالإنجليزية</label>
                                    <input type="text" id="title_en" class="form-control" v-model="form.name_en" required />
                                    <span class="text-danger" v-if="errors.title_en">{{
                                        errors.title_en[0]
                                    }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description_en">الوصف بالإنجليزية</label>
                                    <textarea id="description_en" cols="30" rows="7" v-model="form.desc_en" required
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
    name: "edit_product",
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
                allimages: [],
            },
            errors: [],
            subs: [],
            id: this.$route.params.id,
        };
    },
    mounted() {
        this.fetchproduct();
        this.fetchSubs();
    },
    methods: {
        async fetchproduct() {
            this.loading = true;
            await axios
                .get(`/api/dash/product/show/${this.id}`)
                .then((res) => {
                    this.form = res.data.product;
                })
                .catch(() => {
                    this.$router.push({ name: "error404" });
                });
            this.loading = false;
        },
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
                title: "تم تعديل المنتج بنجاح",
            });
        },

        async saveForm() {
            this.loading = true;
            await axios
                .post(
                    `/api/dash/product/edit/${this.id}`,
                    {
                        title: this.form.name,
                        title_en: this.form.name_en,
                        description: this.form.desc,
                        description_en: this.form.desc_en,
                        amount: this.form.amount,
                        old_price: this.form.old_price,
                        new_price: this.form.new_price,
                        sub_id: this.form.sub_id,
                        images: this.form.images,
                    },
                    {
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
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

        delImage(id) {
            this.$swal
                .fire({
                    title: "هل انت متأكد؟",
                    text: "لن تتمكن من إعادة هذه الخطوة!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "نعم إحذف",
                    cancelButtonText: "الغاء",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.post(`/api/dash/product/image/del/${id}`);
                        this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
                        this.fetchproduct();
                    }
                });
        },

        selectImage() {
            this.form.images = this.$refs.image.files;
        },
    },
};
</script>

<style></style>
