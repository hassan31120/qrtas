<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_coupon />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_coupon from "../../components/coupons/edit.vue";
export default {
  name: "edit_couponPage",
  components: { navbar, sidebar, edit_coupon },
};
</script>

<style></style>
