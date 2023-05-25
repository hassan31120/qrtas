<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">كل الصور</h2>

      <!-- <viewer :images="banners">
        <img v-for="src in banners" :key="src" :src="src.image" class="img-thumbnail" />
      </viewer> -->

      <table class="table mt-5 table-hover">
        <thead style="background-color: #91b307">
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">الصورة</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(banner, index) in banners" :key="banner.id">
            <td scope="row">{{ index + 1 }}</td>
            <td>{{ banner.title }}</td>
            <td>
              <viewer>
                <img :src="banner.image" alt="banner" class="img-thumbnail" width="130" />
              </viewer>
            </td>
            <td class="actions">
              <router-link :to="{ name: 'edit_banner', params: { id: banner.id } }">
                <button type="button"><i class="fe fe-edit fe-16"></i></button
              ></router-link>
              <button type="button" @click="delbanner(banner.id)">
                <i class="fe fe-trash fe-16"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- pagination -->
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
          <li
            class="page-item"
            v-for="link in pagination.links"
            :key="link"
            v-bind:class="[{ disabled: !link.url }, { haha: link.active }]"
          >
            <a
              class="page-link"
              href="#"
              v-html="link.label"
              @click="fetchbanners(link.url)"
            ></a>
          </li>
        </ul>
      </nav>
    </div>
  </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";

export default {
  name: "banners",
  components: { loadingPage },
  data() {
    return {
      banners: [],
      loading: false,
      pagination: {},
    };
  },
  mounted() {
    this.fetchbanners();
  },
  methods: {
    delbanner(id) {
      this.$swal
        .fire({
          title: "هل انت متأكد؟",
          text: "لن تتمكن من إعادة هذه الخطوة!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "نعم إحذف",
          cancelButtonText: "الغاء",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios.post(`api/dash/banner/del/${id}`);
            this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
            this.fetchbanners();
          }
        });
    },
    async fetchbanners(page_url) {
      this.loading = true;
      page_url = page_url || `api/dash/banners`;
      await axios
        .get(page_url)
        .then((res) => {
          this.banners = res.data.data;
          this.makePagination(res.data.meta);
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
      this.loading = false;
    },

    async makePagination(meta) {
      let pagination = {
        links: meta.links,
      };
      this.pagination = pagination;
    },
  },
};
</script>

<style></style>
