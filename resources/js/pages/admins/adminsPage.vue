<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <admins />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import admins from "../../components/admins/all.vue";
export default {
  name: "adminsPage",
  components: { navbar, sidebar, admins },
};
</script>

<style></style>
