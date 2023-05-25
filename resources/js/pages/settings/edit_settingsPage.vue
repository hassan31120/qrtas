<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_settings />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_settings from "../../components/settings/edit.vue";
export default {
  name: "edit_settingsPage",
  components: { navbar, sidebar, edit_settings },
};
</script>

<style></style>
