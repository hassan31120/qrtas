<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_cat />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_cat from "../../components/cats/add.vue";
export default {
  name: "add_catPage",
  components: { navbar, sidebar, add_cat },
};
</script>

<style></style>
