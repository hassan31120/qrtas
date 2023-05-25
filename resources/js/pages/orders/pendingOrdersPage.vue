<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <pending />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import pending from "../../components/orders/pending.vue";
export default {
  name: "pendingOrdersPage",
  components: { navbar, sidebar, pending },
};
</script>

<style></style>
