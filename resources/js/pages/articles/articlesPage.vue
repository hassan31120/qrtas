<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <articles />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import articles from "../../components/articles/all.vue";
export default {
  name: "articlesPage",
  components: { navbar, sidebar, articles },
};
</script>

<style></style>
