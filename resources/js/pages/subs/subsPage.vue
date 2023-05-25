<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <subs />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import subs from "../../components/subs/all.vue";
export default {
  name: "subsPage",
  components: { navbar, sidebar, subs },
};
</script>

<style></style>
