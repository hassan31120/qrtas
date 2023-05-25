<template>
    <main role="main" class="main-content">
        <div v-if="loading">
            <div>
                <loadingPage />
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0">
                        <a href="#" class="text-muted"></a> طلب {{ order.name }}
                    </h2>
                </div>

                <!-- Main content -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Details -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div>
                                        <span class="me-3 mr-2"> {{ order.created_at }} </span>
                                        <span class="me-3 mr-2"> {{ order.pay_status }} </span>
                                        <span v-if="order.status == 'Pending'" class="badge badge-pill badge-warning">{{
                                            order.status }}</span>
                                        <span v-if="order.status == 'Accepted'" class="badge badge-pill badge-success">{{
                                            order.status }}</span>
                                        <span v-if="order.status == 'Declined'" class="badge badge-pill badge-danger">{{
                                            order.status }}</span>
                                    </div>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr v-for="product in order.products" :key="product.id">
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img :src="product.image" alt="image" width="100" height="80"
                                                            style="object-fit: cover" />
                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3"
                                                        style="margin-right: 20px; margin-top: 5px">
                                                        <h6 class="mb-3 mt-2">
                                                            {{ product.title }}
                                                        </h6>
                                                        <span class="">الكمية : {{ product.quantity }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end" style="margin-top: 25px; position: absolute; left: 20px">
                                                {{ product.new_price }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <hr />
                                    <tfoot style="position: relative; top: 25px; right: 20px">
                                        <tr>
                                            <td colspan="2">سعر الطلب</td>
                                            <td class="text-end" style="position: absolute; left: 20px">
                                                {{ order.total }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">سعر الشحن</td>
                                            <td class="text-end" style="position: absolute; left: 20px">
                                                {{ order.shipping }}
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="2">الإجمالي</td>
                                            <td class="text-end" style="position: absolute; left: 20px">
                                                {{ order.grandTotal }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- user info -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>معلومات المشتري</h6>
                                        <hr>
                                        الاسم: {{ order.name }} <br />
                                        البريد الالكتروني: {{ order.email }} <br />
                                        الهاتف: {{ order.number }} <br />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>طريقة الدفع</h6>
                                        <hr>
                                        الإجمالي: {{ order.grandTotal }} <br />
                                        <span>{{ order.pay_status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <!-- Shipping information -->
                            <div class="card-body">
                                <div style="position: relative;">
                                    <h6>معلومات الشحن</h6>
                                    <img src="@/assets/aramex.webp" alt="aramex" width="100" height="40"
                                        style="position: absolute; left:0; top:0; margin-left:-10px; margin-top:-10px">
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="h6">العنوان</h3>
                                        <address>
                                            <strong>{{ order.address_name }}</strong><br />
                                            <p>{{ order.address_desc }}</p>
                                        </address>
                                    </div>
                                    <div class="col-6">
                                        <h3 class="h6">المدينة</h3>
                                        <strong>{{ order.address_gov }}</strong>
                                        <p>{{ order.address_city }}</p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <a :href="order.shipment_link" class="btn btn-hassan" target="_blank">بوليصة
                                            الشحن</a>
                                        <a :href="'https://www.aramex.com/track/results?ShipmentNumber=' + order.shipment_id"
                                            class="btn btn-hassan ml-2" target="_blank">تتبع الشحنة</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";
import axios from "axios";

export default {
    name: "one",
    components: { loadingPage },
    data() {
        return {
            order: {},
            loading: false,
            id: this.$route.params.id,
        };
    },
    mounted() {
        this.fetchorder();
    },
    methods: {
        async fetchorder() {
            this.loading = true;
            await axios
                .get(`/api/dash/order/${this.id}`)
                .then((res) => {
                    this.order = res.data.order;
                })
                .catch(() => {
                    this.$router.push({ name: "serverErr" });
                });
            this.loading = false;
        },
    },
};
</script>

<style scoped>
.card {
    box-shadow: 0 0.5rem 1rem rgba(18, 38, 63, 0.05) !important;
}
</style>
