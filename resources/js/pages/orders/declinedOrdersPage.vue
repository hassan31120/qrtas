<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <declined />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import declined from "../../components/orders/declined.vue";
export default {
  name: "declinedOrdersPage",
  components: { navbar, sidebar, declined },
};
</script>

<style></style>
