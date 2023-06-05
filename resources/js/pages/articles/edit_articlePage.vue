<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_article />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_article from "../../components/articles/edit.vue";
export default {
  name: "edit_articlePage",
  components: { navbar, sidebar, edit_article },
};
</script>

<style></style>
