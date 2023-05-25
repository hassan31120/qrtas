<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <home />
  </div>
</template>

<script>
import navbar from "../components/layouts/navbar.vue";
import sidebar from "../components/layouts/sidebar.vue";
import home from "../components/home.vue";
export default {
  name: "homePage",
  components: { navbar, sidebar, home },
};
</script>

<style></style>
