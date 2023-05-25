<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <cats />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import cats from "../../components/cats/all.vue";
export default {
  name: "catsPage",
  components: { navbar, sidebar, cats },
};
</script>

<style></style>
