const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            {
                //Quản lý users
                path: "users",
                name: "admin-users",
                component: () => import ("../pages/admin/users/index.vue")
            },
            {
                //Quản lý users/create
                path: "users/create",
                name: "admin-users-create",
                component: () => import ("../pages/admin/users/create.vue")
            },
            {
                //Quản lý users/eidt
                path: "users/:id/edit",
                name: "admin-users-edit",
                component: () => import ("../pages/admin/users/edit.vue")
            },
            {
                //Quản lý roles
                path: "roles",
                name: "admin-roles",
                component: () => import ("../pages/admin/roles/index.vue")
            },
            {
                //Quản lý settings
                path: "settings",
                name: "admin-settings",
                component: () => import ("../pages/admin/settings/index.vue")
            },

        ]
    }
];


export default admin;
