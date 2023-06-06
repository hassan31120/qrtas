<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <edit_link />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import edit_link from "../../components/links/edit.vue";
export default {
  name: "contactsPage",
  components: { navbar, sidebar, edit_link },
};
</script>

<style></style>
