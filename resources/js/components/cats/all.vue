<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">كل الأقسام الرئيسية</h2>

      <table class="table mt-5 table-hover">
        <thead style="background-color: #a1484d">
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">الصورة</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cat, index) in cats" :key="cat.id">
            <td scope="row">{{ index + 1 }}</td>
            <td>
              <router-link :to="{ name: 'cat_products', params: { id: cat.id } }">
                {{ cat.name }}
              </router-link>
            </td>
            <td><img :src="cat.image" alt="cat" class="img-thumbnail" width="130" /></td>
            <td class="actions">
              <router-link :to="{ name: 'edit_cat', params: { id: cat.id } }">
                <button type="button"><i class="fe fe-edit fe-16"></i></button
              ></router-link>
              <button type="button" @click="delcat(cat.id)">
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
              @click="fetchcats(link.url)"
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
  name: "cats",
  components: { loadingPage },
  data() {
    return {
      cats: [],
      loading: false,
      pagination: {},
    };
  },
  mounted() {
    this.fetchcats();
  },
  methods: {
    delcat(id) {
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
            axios.post(`api/dash/cat/del/${id}`);
            this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
            this.fetchcats();
          }
        });
    },
    async fetchcats(page_url) {
      this.loading = true;
      page_url = page_url || `api/dash/cats`;
      await axios
        .get(page_url)
        .then((res) => {
          this.cats = res.data.data;
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
