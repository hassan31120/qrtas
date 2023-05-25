<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_sub />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_sub from "../../components/subs/add.vue";
export default {
  name: "add_subPage",
  components: { navbar, sidebar, add_sub },
};
</script>

<style></style>
