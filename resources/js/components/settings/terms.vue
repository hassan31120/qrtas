<template>
  <p class="pb-5" v-html="settings.terms_ar"></p>
</template>

<script>
import axios from "axios";

export default {
  name: "terms",
  data() {
    return {
      settings: [],
    };
  },
  mounted() {
    this.fetchSettings();
  },
  methods: {
    async fetchSettings() {
      await axios
        .get(`api/dash/settings`)
        .then((res) => {
          this.settings = res.data.settings;
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
    },
  },
};
</script>

<style></style>
