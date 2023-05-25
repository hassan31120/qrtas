<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <cities />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import cities from "../../components/cities/all.vue";
export default {
  name: "citiesPage",
  components: { navbar, sidebar, cities },
};
</script>

<style></style>
