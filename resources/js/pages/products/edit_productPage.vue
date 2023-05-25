<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_product />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_product from "../../components/products/edit.vue";
export default {
  name: "edit_productPage",
  components: { navbar, sidebar, edit_product },
};
</script>

<style></style>
