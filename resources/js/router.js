import { createRouter, createWebHistory } from "vue-router";
import Dash from "@/Components/Dash.vue";
import FormFormat from "@/Components/FormFormat.vue";
import MainLayout from "@/Components/MainLayout.vue";
import AuthLayout from "@/Components/AuthLayout.vue";
import LogIn from "@/Components/LogIn.vue";
import Register from "@/Components/Register.vue";
import store from "@/stores";

const routes = [
    {
        path: "/",
        component: MainLayout,
        children: [
            {
                path: "",
                name: "Dash",
                component: Dash,
                meta: {
                    middleware: "admin",
                    title: "Dashboard",
                },
            },
            {
                path: "form",
                name: "Form",
                component: FormFormat,
                meta: {
                    middleware: "admin",
                    title: "Form Demo",
                },
            },
        ],
    },
    {
        path: "/auth",
        component: AuthLayout,
        children: [
            {
                path: "login",
                name: "Login",
                component: LogIn,
                meta: {
                    middleware: "guest",
                    title: "Login",
                },
            },
            {
                path: "register",
                name: "Register",
                component: Register,
                meta: {
                    middleware: "admin",
                    title: "Register",
                },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 };
    },
});

router.beforeEach((to, from, next) => {
    const title = to.meta.title;
    if (title) {
        document.title = title;
    }
    if (to.meta.middleware == "guest") {
        next();
    } else {
        if (store.state.auth.authenticated) {
            axios
                .get("/api/user")
                .then((response) => {
                    // User is authenticated
                    console.log(response);
                    next();
                })
                .catch((error) => {
                    // User is not authenticated
                    console.error(error);
                    store.commit("auth/SET_AUTHENTICATED", false);
                    next({ name: "Login" });
                });
        } else {
            next({ name: "Login" });
        }
    }
});

export default router;
