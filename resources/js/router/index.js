import { createRouter, createWebHistory } from "vue-router";
import axios from "axios";
import homePage from "../pages/HomePage.vue";
import allusersPage from "../pages/users/allusersPage.vue";
import add_userPage from "../pages/users/add_userPage.vue";
import edit_userPage from "../pages/users/edit_userPage.vue";
import adminsPage from "../pages/admins/adminsPage.vue";
import add_adminPage from "../pages/admins/add_adminPage.vue";
import edit_adminPage from "../pages/admins/edit_adminPage.vue";
import citiesPage from "../pages/cities/citiesPage.vue";
import add_cityPage from "../pages/cities/add_cityPage.vue";
import edit_cityPage from "../pages/cities/edit_cityPage.vue";
import catsPage from "../pages/cats/catsPage.vue";
import add_catPage from "../pages/cats/add_catPage.vue";
import edit_catPage from "../pages/cats/edit_catPage.vue";
import subsPage from "../pages/subs/subsPage.vue";
import add_subPage from "../pages/subs/add_subPage.vue";
import edit_subPage from "../pages/subs/edit_subPage.vue";
import bannersPage from "../pages/banners/bannersPage.vue";
import add_bannerPage from "../pages/banners/add_bannerPage.vue";
import edit_bannerPage from "../pages/banners/edit_bannerPage.vue";
import login from "../components/auth/login.vue";
import error404 from "../components/errors/error404.vue";
import error500 from "../components/errors/error500.vue";
import productsPage from "../pages/products/productsPage.vue";
import add_productPage from "../pages/products/add_productPage.vue";
import edit_productPage from "../pages/products/edit_productPage.vue";
import pendingOrdersPage from "../pages/orders/pendingOrdersPage.vue";
import acceptedOrdersPage from "../pages/orders/acceptedOrdersPage.vue";
import declinedOrdersPage from "../pages/orders/declinedOrdersPage.vue";
import oneOrderPage from "../pages/orders/oneOrderPage.vue";
import notiPage from "../pages/noti/notiPage.vue";
import settingsPage from "../pages/settings/settingsPage.vue";
import edit_settingsPage from "../pages/settings/edit_settingsPage.vue";
import about from "../components/settings/about.vue";
import terms from "../components/settings/terms.vue";
import support from "../components/settings/support.vue";
import privacy from "../components/settings/privacy.vue";
import contact from "../components/settings/contact.vue";
import subProductsPage from '../pages/subs/subProductsPage.vue';
import catProductsPage from '../pages/cats/catProductsPage.vue';
import couponsPage from "../pages/coupons/couponsPage.vue";
import add_couponPage from "../pages/coupons/add_couponPage.vue";
import edit_couponPage from "../pages/coupons/edit_couponPage.vue";

import articlesPage from "../pages/articles/articlesPage.vue";
import add_articlePage from "../pages/articles/add_articlePage.vue";
import edit_articlePage from "../pages/articles/edit_articlePage.vue";

import contactsPage from "../pages/contacts/contactsPage.vue";


const routes = [
    {
        path: "/",
        name: "home",
        component: homePage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/:catchAll(.*)*",
        name: "error404",
        component: error404,
    },
    {
        path: "/serverErr",
        name: "error500",
        component: error500,
    },
    {
        path: "/login",
        name: "login",
        component: login,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    return next({ name: "home" });
                })
                .catch(() => {
                    next();
                });
        },
    },
    {
        path: "/users",
        name: "users",
        component: allusersPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_user",
        name: "add_user",
        component: add_userPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_user/:id",
        name: "edit_user",
        component: edit_userPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/admins",
        name: "admins",
        component: adminsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_admin",
        name: "add_admin",
        component: add_adminPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_admin/:id",
        name: "edit_admin",
        component: edit_adminPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/cities",
        name: "cities",
        component: citiesPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_city",
        name: "add_city",
        component: add_cityPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_city/:id",
        name: "edit_city",
        component: edit_cityPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/noti",
        name: "noti",
        component: notiPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/cats",
        name: "cats",
        component: catsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_cat",
        name: "add_cat",
        component: add_catPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_cat/:id",
        name: "edit_cat",
        component: edit_catPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/subs",
        name: "subs",
        component: subsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_sub",
        name: "add_sub",
        component: add_subPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_sub/:id",
        name: "edit_sub",
        component: edit_subPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/banners",
        name: "banners",
        component: bannersPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_banner",
        name: "add_banner",
        component: add_bannerPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_banner/:id",
        name: "edit_banner",
        component: edit_bannerPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/products",
        name: "products",
        component: productsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_product",
        name: "add_product",
        component: add_productPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_product/:id",
        name: "edit_product",
        component: edit_productPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/settings",
        name: "settings",
        component: settingsPage,
        children: [
            {
                path: "/about",
                name: "about",
                component: about,
            },
            {
                path: "/contact",
                name: "contact",
                component: contact,
            },
            {
                path: "/privacy",
                name: "privacy",
                component: privacy,
            },
            {
                path: "/terms",
                name: "terms",
                component: terms,
            },
            {
                path: "/support",
                name: "support",
                component: support,
            },
        ],
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_settings",
        name: "edit_settings",
        component: edit_settingsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/orders",
        name: "orders",
        component: pendingOrdersPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/declined",
        name: "declined",
        component: declinedOrdersPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/accepted",
        name: "accepted",
        component: acceptedOrdersPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/order/:id",
        name: "order",
        component: oneOrderPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/sub_products/:id",
        name: "sub_products",
        component: subProductsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/cat_products/:id",
        name: "cat_products",
        component: catProductsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/coupons",
        name: "coupons",
        component: couponsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_coupon",
        name: "add_coupon",
        component: add_couponPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_coupon/:id",
        name: "edit_coupon",
        component: edit_couponPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/articles",
        name: "articles",
        component: articlesPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/add_article",
        name: "add_article",
        component: add_articlePage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch((err) => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/edit_article/:id",
        name: "edit_article",
        component: edit_articlePage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/contacts",
        name: "contacts",
        component: contactsPage,
        beforeEnter: (to, from, next) => {
            axios
                .get(`api/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
