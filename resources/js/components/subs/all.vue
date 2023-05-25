<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">كل الأقسام الفرعية</h2>

      <table class="table mt-5 table-hover">
        <thead style="background-color: #91b307">
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">القسم الرئيسي</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(sub, index) in subs" :key="sub.id">
            <td scope="row">{{ index + 1 }}</td>
            <td>
              <router-link :to="{ name: 'sub_products', params: { id: sub.id } }">
                {{ sub.name }}
              </router-link>
            </td>
            <td>{{ sub.cat }}</td>
            <td class="actions">
              <router-link :to="{ name: 'edit_sub', params: { id: sub.id } }">
                <button type="button"><i class="fe fe-edit fe-16"></i></button
              ></router-link>
              <button type="button" @click="delsub(sub.id)">
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
              @click="fetchsubs(link.url)"
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
  name: "subs",
  components: { loadingPage },
  data() {
    return {
      subs: [],
      loading: false,
      pagination: {},
    };
  },
  mounted() {
    this.fetchsubs();
  },
  methods: {
    delsub(id) {
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
            axios.post(`api/dash/sub/del/${id}`);
            this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
            this.fetchsubs();
          }
        });
    },
    async fetchsubs(page_url) {
      this.loading = true;
      page_url = page_url || `api/dash/subs`;
      await axios
        .get(page_url)
        .then((res) => {
          this.subs = res.data.data;
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
