<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_user />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_user from "../../components/users/add.vue";
export default {
  name: "add_userPage",
  components: { navbar, sidebar, add_user },
};
</script>

<style></style>
