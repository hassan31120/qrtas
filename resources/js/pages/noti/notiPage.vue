<template>
  <div class="wrapper">
    <navbar />
    <sidebar />
    <noti />
  </div>
</template>

<script>
import navbar from "../../components/layouts/navbar.vue";
import sidebar from "../../components/layouts/sidebar.vue";
import noti from "../../components/noti/noti.vue";
export default {
  name: "notiPage",
  components: { navbar, sidebar, noti },
};
</script>

<style></style>
