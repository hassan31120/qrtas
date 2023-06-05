<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <add_article />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import add_article from "../../components/articles/add.vue";
export default {
  name: "add_articlePage",
  components: { navbar, sidebar, add_article },
};
</script>

<style></style>
