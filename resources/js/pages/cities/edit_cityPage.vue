<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_city />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_city from "../../components/cities/edit.vue";
export default {
  name: "edit_cityPage",
  components: { navbar, sidebar, edit_city },
};
</script>

<style></style>
