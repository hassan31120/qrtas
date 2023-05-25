<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_sub />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_sub from "../../components/subs/edit.vue";
export default {
  name: "edit_subPage",
  components: { navbar, sidebar, edit_sub },
};
</script>

<style></style>
