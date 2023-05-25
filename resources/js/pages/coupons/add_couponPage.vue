<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_coupon />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_coupon from "../../components/coupons/add.vue";
export default {
  name: "add_couponPage",
  components: { navbar, sidebar, add_coupon },
};
</script>

<style></style>
