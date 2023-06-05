<template>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <router-link class="navbar-brand mx-auto mt-4 mb-2 flex-fill text-center" :to="{ name: 'home' }"><img
                        src="@/assets/qrtas.png" alt="logo" width="130" />
                </router-link>
            </div>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item dropdown">
                    <a href="#admins" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-user-check fe-16"></i>
                        <span class="ml-3 item-text">المسؤولين</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="admins">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'admins' }"><span class="ml-1 item-text">كل
                                    المسؤولين</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_admin' }"><span
                                    class="ml-1 item-text">إضافة مسؤول جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#members" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">الأعضاء</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="members">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'users' }"><span class="ml-1 item-text">كل
                                    الأعضاء</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_user' }"><span class="ml-1 item-text">إضافة
                                    عضو جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#noti" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-bell fe-16"></i>
                        <span class="ml-3 item-text">الإشعارات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="noti">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'noti' }"><span class="ml-1 item-text">إرسال
                                    اشعار جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#city" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-globe fe-16"></i>
                        <span class="ml-3 item-text">المدن</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="city">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'cities' }"><span class="ml-1 item-text">كل
                                    المدن</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_city' }"><span class="ml-1 item-text">إضافة
                                    مدينة جديدة</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#cats" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-layers fe-16"></i>
                        <span class="ml-3 item-text">الأقسام الرئيسية</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="cats">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'cats' }"><span class="ml-1 item-text">كل
                                    الأقسام الرئيسية</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_cat' }"><span class="ml-1 item-text">إضافة
                                    قسم جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#subs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-tag fe-16"></i>
                        <span class="ml-3 item-text">الأقسام الفرعية</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="subs">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'subs' }"><span class="ml-1 item-text">كل
                                    الأقسام الفرعية</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_sub' }"><span class="ml-1 item-text">إضافة
                                    قسم جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#images" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-image fe-16"></i>
                        <span class="ml-3 item-text">الصور</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="images">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'banners' }"><span class="ml-1 item-text">كل
                                    الصور</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_banner' }"><span
                                    class="ml-1 item-text">إضافة صورة جديدة</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-database fe-16"></i>
                        <span class="ml-3 item-text">المنتجات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="products">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'products' }"><span class="ml-1 item-text">كل
                                    المنتجات</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_product' }"><span
                                    class="ml-1 item-text">إضافة منتج جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#coupons" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-percent fe-16"></i>
                        <span class="ml-3 item-text">الكوبونات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="coupons">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'coupons' }"><span class="ml-1 item-text">كل
                                    الكوبونات</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_coupon' }"><span
                                    class="ml-1 item-text">إضافة كوبون جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">الإعدادات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="settings">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'about' }"><span class="ml-1 item-text">كل
                                    الإعدادات</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'edit_settings' }"><span
                                    class="ml-1 item-text">تعديل الإعدادات</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-package fe-16"></i>
                        <span class="ml-3 item-text">الطلبات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="orders">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'orders' }"><span class="ml-1 item-text">كل
                                    الطلبات المعلقة</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'accepted' }"><span class="ml-1 item-text">كل
                                    الطلبات المقبولة</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'declined' }"><span class="ml-1 item-text">كل
                                    الطلبات المرفوضة</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#articles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-edit-3 fe-16"></i>
                        <span class="ml-3 item-text">المقالات</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="articles">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'articles' }"><span class="ml-1 item-text">
                                    كل المقالات</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'add_article' }"><span
                                    class="ml-1 item-text">إضافة
                                    مقال جديد</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#contacts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-share-2 fe-16"></i>
                        <span class="ml-3 item-text">طلبات التواصل</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="contacts">
                        <li class="nav-item">
                            <router-link class="nav-link pl-3" :to="{ name: 'contacts' }">
                                <span class="ml-1 item-text">كل طلبات التواصل</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="btn-box w-100 mt-4 mb-1">
                <button @click.prevent="logout" class="btn mb-2 btn-lg btn-block"
                    style="background-color: #91b307; border-radius: 50px; color: #fff !important">
                    <i class="fe fe-log-out fe-12 mr-2" style="font-weight: 700 !important"></i><span class="small"
                        style="font-weight: 700 !important">تسجيل الخروج</span>
                </button>
            </div>
        </nav>
    </aside>
</template>

<script>
export default {
    name: "sidebar",

    mounted() { },
    methods: {
        async logout() {
            await axios
                .post(`/api/logout`)
                .then((res) => {
                    console.log(res);
                    this.$router.push({ name: "login" });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style scoped>
ul a.router-link-exact-active {
    background-color: #a1484c10 !important;
    color: #91b307 !important;
}
</style>
