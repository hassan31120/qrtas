<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <users />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import users from "../../components/users/all.vue";
export default {
  name: "allusersPage",
  components: { navbar, sidebar, users },
};
</script>

<style></style>
