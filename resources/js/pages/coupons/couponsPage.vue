<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <coupons />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import coupons from "../../components/coupons/all.vue";
export default {
  name: "couponsPage",
  components: { navbar, sidebar, coupons },
};
</script>

<style></style>
