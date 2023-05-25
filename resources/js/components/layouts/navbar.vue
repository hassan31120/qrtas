<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navHassan">
    <div class="w-99 mb-4 d-flex">
      <router-link
        class="navbar-brand mx-auto mt-3 flex-fill text-center"
        :to="{ name: 'home' }"
      >
        <img src="@/assets/qrtas.png" alt="logo" width="80" />
      </router-link>
    </div>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
          <a
            href="#admins"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-user-check fe-16"></i>
            <span class="ml-3 item-text">المسؤولين</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="admins">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'admins' }"
                ><span class="ml-1 item-text">كل المسؤولين</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_admin' }"
                ><span class="ml-1 item-text">إضافة مسؤول جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#members"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-users fe-16"></i>
            <span class="ml-3 item-text">الأعضاء</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="members">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'users' }"
                ><span class="ml-1 item-text">كل الأعضاء</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_user' }"
                ><span class="ml-1 item-text">إضافة عضو جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#noti"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-bell fe-16"></i>
            <span class="ml-3 item-text">الإشعارات</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="noti">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'noti' }"
                ><span class="ml-1 item-text">إرسال اشعار جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#city"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-globe fe-16"></i>
            <span class="ml-3 item-text">المدن</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="city">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'cities' }"
                ><span class="ml-1 item-text">كل المدن</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_city' }"
                ><span class="ml-1 item-text">إضافة مدينة جديدة</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#cats"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-layers fe-16"></i>
            <span class="ml-3 item-text">الأقسام الرئيسية</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="cats">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'cats' }"
                ><span class="ml-1 item-text">كل الأقسام الرئيسية</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_cat' }"
                ><span class="ml-1 item-text">إضافة قسم جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#subs"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-tag fe-16"></i>
            <span class="ml-3 item-text">الأقسام الفرعية</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="subs">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'subs' }"
                ><span class="ml-1 item-text">كل الأقسام الفرعية</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_sub' }"
                ><span class="ml-1 item-text">إضافة قسم جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#images"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-image fe-16"></i>
            <span class="ml-3 item-text">الصور</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="images">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'banners' }"
                ><span class="ml-1 item-text">كل الصور</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_banner' }"
                ><span class="ml-1 item-text">إضافة صورة جديدة</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#products"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-database fe-16"></i>
            <span class="ml-3 item-text">المنتجات</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="products">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'products' }"
                ><span class="ml-1 item-text">كل المنتجات</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'add_product' }"
                ><span class="ml-1 item-text">إضافة منتج جديد</span>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            href="#settings"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-settings fe-16"></i>
            <span class="ml-3 item-text">الإعدادات</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="settings">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'about' }"
                ><span class="ml-1 item-text">كل الإعدادات</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'edit_settings' }"
                ><span class="ml-1 item-text">تعديل الإعدادات</span>
              </router-link>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a
            href="#orders"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle nav-link"
          >
            <i class="fe fe-package fe-16"></i>
            <span class="ml-3 item-text">الطلبات</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="orders">
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'orders' }"
                ><span class="ml-1 item-text">كل الطلبات المعلقة</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'accepted' }"
                ><span class="ml-1 item-text">كل الطلبات المقبولة</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link pl-3" :to="{ name: 'declined' }"
                ><span class="ml-1 item-text">كل الطلبات المرفوضة</span>
              </router-link>
            </li>
          </ul>
        </li>
      </ul>
      <div class="btn-box w-100 mt-4 mb-1">
        <button
          @click.prevent="logout"
          class="btn mb-2 btn-lg btn-block"
          style="background-color: #91b307; border-radius: 50px; color: #fff !important"
        >
          <i class="fe fe-log-out fe-12 mr-2" style="font-weight: 700 !important"></i
          ><span class="small" style="font-weight: 700 !important">تسجيل الخروج</span>
        </button>
      </div>
    </div>
  </nav>

  <nav class="topnav navbar navbar-light">
    <!-- <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button> -->
    <!-- <form class="form-inline mr-auto searchform text-muted">
      <input
        class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted"
        type="search"
        placeholder="Type something..."
        aria-label="Search"
      />
    </form> -->
    <ul class="nav">
      <!-- <li class="nav-item">
        <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
          <i class="fe fe-sun fe-16"></i>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link text-muted my-2"
          href="./#"
          data-toggle="modal"
          data-target=".modal-shortcut"
        >
          <span class="fe fe-grid fe-16"></span>
        </a>
      </li>
      <li class="nav-item nav-notif">
        <a
          class="nav-link text-muted my-2"
          href="./#"
          data-toggle="modal"
          data-target=".modal-notif"
        >
          <span class="fe fe-bell fe-16"></span>
          <span class="dot dot-md bg-success"></span>
        </a>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <i class="fe fe-user"></i>
        {{ this.user.name }}
      </li> -->
    </ul>
  </nav>
</template>

<script>
export default {
  name: "navbar",
  data() {
    return {
      user: {},
      log: "",
    };
  },
  mounted() {},
  methods: {
    async logout() {
      await axios.post(`/api/logout`).then(() => {
        this.$router.push({ name: "login" });
      });
    },
  },
};
</script>

<style>
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 992px) {
  .navHassan {
    display: none;
  }
}
</style>
