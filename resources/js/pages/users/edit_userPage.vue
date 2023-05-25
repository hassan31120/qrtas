<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_user />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_user from "../../components/users/edit.vue";
export default {
  name: "edit_userPage",
  components: { navbar, sidebar, edit_user },
};
</script>

<style></style>
