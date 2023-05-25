<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_product />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_product from "../../components/products/add.vue";
export default {
  name: "add_productPage",
  components: { navbar, sidebar, add_product },
};
</script>

<style></style>
