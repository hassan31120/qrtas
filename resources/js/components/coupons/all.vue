<template>
    <main role="main" class="main-content">
        <div v-if="loading">
            <div>
                <loadingPage />
            </div>
        </div>
        <div class="container-fluid">
            <h2 class="h5 page-title pb-5">كل الكوبونات</h2>

            <!-- <viewer :images="coupons">
        <img v-for="src in coupons" :key="src" :src="src.image" class="img-thumbnail" />
      </viewer> -->

            <table class="table mt-5 table-hover">
                <thead style="background-color: #a1484d">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الكود</th>
                        <th scope="col">نسبة الخصم</th>
                        <th scope="col">تاريخ البداية</th>
                        <th scope="col">تاريخ النهاية</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(coupon, index) in coupons" :key="coupon.id">
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ coupon.code }}</td>
                        <td>{{ coupon.discount_percentage }} %</td>
                        <td>{{ coupon.start_date }}</td>
                        <td>{{ coupon.end_date }}</td>
                        <td class="actions">
                            <router-link :to="{ name: 'edit_coupon', params: { id: coupon.id } }">
                                <button type="button"><i class="fe fe-edit fe-16"></i></button></router-link>
                            <button type="button" @click="delcoupon(coupon.id)">
                                <i class="fe fe-trash fe-16"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item" v-for="link in pagination.links" :key="link"
                        v-bind:class="[{ disabled: !link.url }, { haha: link.active }]">
                        <a class="page-link" href="#" v-html="link.label" @click="fetchcoupons(link.url)"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";

export default {
    name: "coupons",
    components: { loadingPage },
    data() {
        return {
            coupons: [],
            loading: false,
            pagination: {},
        };
    },
    mounted() {
        this.fetchcoupons();
    },
    methods: {
        delcoupon(id) {
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
                        axios.post(`api/dash/coupon/del/${id}`);
                        this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
                        this.fetchcoupons();
                    }
                });
        },
        async fetchcoupons(page_url) {
            this.loading = true;
            page_url = page_url || `api/dash/coupons`;
            await axios
                .get(page_url)
                .then((res) => {
                    this.coupons = res.data.data;
                    this.makePagination(res.data.meta);
                })
                .catch(() => {
                    this.$router.push({ name: "serverErr" });
                });
            this.loading = false;
        },

        async makePagination(meta) {
            let pagination = {
                links: meta.links,
            };
            this.pagination = pagination;
        },
    },
};
</script>

<style></style>
