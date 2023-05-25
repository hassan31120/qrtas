<template>
  <main role="main" class="main-content">
    <div class="container-fluid">
      <div v-if="loading">
        <div><loadingPage /></div>
      </div>
      <h2 class="h5 page-title pb-5">كل الإعدادات</h2>
      <nav class="pb-0">
        <router-link :to="{ name: 'about' }">من نحن </router-link>
        <router-link :to="{ name: 'contact' }">تواصل معنا</router-link>
        <router-link :to="{ name: 'privacy' }">سياسة الخصوصية </router-link>
        <router-link :to="{ name: 'terms' }">الشروط والأحكام </router-link>
        <!-- <router-link :to="{ name: 'support' }">الدعم</router-link> -->
      </nav>
      <hr />
    </div>
    <router-view></router-view>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: "settings",
  data() {
    return {
      settings: {},
      loading: false,
    };
  },
  mounted() {
    this.fetchSettings();
  },
  methods: {
    async fetchSettings() {
      this.loading = true;
      await axios
        .get(`api/dash/settings`)
        .then((res) => {
          this.settings = res.data.settings;
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
      this.loading = false;
    },
  },
};
</script>

<style scoped>
nav {
  padding: 30px;
}
nav a {
  padding: 0px 30px 10px 30px;
  font-weight: bold;
  color: #2c3e50;
  text-decoration: none;
}
.router-link-exact-active {
  color: #91b307;
  border-bottom: 2px solid #91b307;
}

hr {
  font-weight: 900;
}
</style>
