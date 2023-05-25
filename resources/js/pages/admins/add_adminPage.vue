<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_admin />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_admin from "../../components/admins/add.vue";
export default {
  name: "add_adminPage",
  components: { navbar, sidebar, add_admin },
};
</script>

<style></style>
