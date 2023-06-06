<template>
    <main role="main" class="main-content">
        <div v-if="loading">
            <div>
                <loadingPage />
            </div>
        </div>
        <div class="container-fluid">
            <h2 class="h5 page-title pb-5">كل بيانات الموقع</h2>

            <table class="table mt-5 table-hover">
                <thead style="background-color: #91b307">
                    <tr>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">الهاتف</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">اللوقو</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ link.email }}</td>
                        <td>{{ link.number }}</td>
                        <td>{{ link.address }}</td>
                        <td><img :src="link.logo" alt="logo" width="100" height="100" style="object-fit: contain;"></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";
import axios from "axios";

export default {
    name: "links",
    components: { loadingPage },
    data() {
        return {
            link: {},
            loading: false,
        };
    },
    mounted() {
        this.fetchlink();
    },
    methods: {
        async fetchlink() {
            this.loading = true;
            await axios
                .get(`api/dash/link`)
                .then((res) => {
                    this.link = res.data.data;
                    console.log(res);
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
