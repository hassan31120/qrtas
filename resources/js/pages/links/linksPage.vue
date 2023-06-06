<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <links />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import links from "../../components/links/all.vue";
export default {
  name: "linkssPage",
  components: { navbar, sidebar, links },
};
</script>

<style></style>
