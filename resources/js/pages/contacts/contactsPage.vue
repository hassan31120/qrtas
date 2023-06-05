<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <contacts />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import contacts from "../../components/contacts/all.vue";
export default {
  name: "contactsPage",
  components: { navbar, sidebar, contacts },
};
</script>

<style></style>
