<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_banner />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_banner from "../../components/banners/edit.vue";
export default {
  name: "edit_bannerPage",
  components: { navbar, sidebar, edit_banner },
};
</script>

<style></style>
