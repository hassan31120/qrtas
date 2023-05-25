<template>
  <h6 class="pb-3 mt-5"><span style="font-weight: 700;">بريد الدعم : </span>{{ settings.email }}</h6>
  <h6 class="pb-3"><span style="font-weight: 700;">رقم الدعم :</span>{{ settings.mobile }}</h6>
  <h6 class="pb-3"><span style="font-weight: 700;">واتساب الدعم : </span>{{ settings.whatsapp }}</h6>
</template>

<script>
import axios from "axios";

export default {
  name: "support",
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
        .get(`api/settings`)
        .then((res) => {
          this.settings = res.data.setting;
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
    },
  },
};
</script>

<style></style>
