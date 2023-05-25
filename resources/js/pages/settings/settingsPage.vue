<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <settings />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import settings from "../../components/settings/all.vue";
export default {
  name: "settingsPage",
  components: { navbar, sidebar, settings },
};
</script>

<style></style>
