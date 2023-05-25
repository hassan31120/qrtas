<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <banners />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import banners from "../../components/banners/all.vue";
export default {
  name: "bannersPage",
  components: { navbar, sidebar, banners },
};
</script>

<style></style>
