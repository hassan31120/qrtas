<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_admin />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_admin from "../../components/admins/edit.vue";
export default {
  name: "edit_adminPage",
  components: { navbar, sidebar, edit_admin },
};
</script>

<style></style>
