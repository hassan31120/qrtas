<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_banner />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_banner from "../../components/banners/add.vue";
export default {
  name: "add_bannerPage",
  components: { navbar, sidebar, add_banner },
};
</script>

<style></style>
