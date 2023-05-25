<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_city />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_city from "../../components/cities/add.vue";
export default {
  name: "add_cityPage",
  components: { navbar, sidebar, add_city },
};
</script>

<style></style>
