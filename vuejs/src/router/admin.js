const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            {
                path: "categories",
                name: "admin-categoy",
                component: () => import("../pages/admin/categories/index.vue"),
            },
            {
                path: "countries",
                name: "admin-county",
                component: () => import("../pages/admin/countries/index.vue"),
            },
            {
                path: "genres",
                name: "admin-genre",
                component: () => import("../pages/admin/genres/index.vue"),
            },
            {
                path: "movies",
                name: "admin-movie",
                component: () => import("../pages/admin/movies/index.vue"),
            },
            {
                path: "users",
                name: "admin-users",
                component: () => import("../pages/admin/users/index.vue"),
            },
        ]
    }
]

export default admin;