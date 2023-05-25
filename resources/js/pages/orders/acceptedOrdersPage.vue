<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <accepted />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import accepted from "../../components/orders/accepted.vue";
export default {
  name: "acceptedOrdersPage",
  components: { navbar, sidebar, accepted },
};
</script>

<style></style>
