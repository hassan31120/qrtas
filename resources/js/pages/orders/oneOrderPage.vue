<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <one />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import one from "../../components/orders/one.vue";
export default {
  name: "oneOrderPage",
  components: { navbar, sidebar, one },
};
</script>

<style></style>
