<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <products />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import products from "../../components/products/all.vue";
export default {
  name: "productsPage",
  components: { navbar, sidebar, products },
};
</script>

<style></style>
