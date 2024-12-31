import { createRouter, createWebHistory } from "vue-router";

import AllFilmsView from "./views/AllFilmsView.vue";
import SingleFilmView from "./views/SingleFilmView.vue";
import CreateFilmView from "./views/CreateFilmView.vue";
import EditFilmView from "./views/EditFilmView.vue";
import AdminAuthView from "./views/AdminAuthView.vue";
import { useAdminStore } from "./stores/admin";

const routes = [
    { path: '/', component: AllFilmsView, name: 'films.index' },
    { path: '/films/:id', component: SingleFilmView, name: 'films.show' },
    { path: '/films/create', component: CreateFilmView, name: 'films.create' },
    { path: '/films/:id/edit', component: EditFilmView, name: 'films.edit' },
    { path: '/admin/auth', component: AdminAuthView, name: 'admin.auth' }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const onlyForAdmin = [
    'films.create',
    'films.edit',
];

const onlyForGuests = [
    'admin.auth'
];

router.beforeEach((to) => {
    const adminStore = useAdminStore();

    // Если админ и пытается в только гостевые страницы
    if (onlyForGuests.includes(to.name as string) && adminStore.isAdmin) {
        return false;
    }

    // Если гость и пытается в админку
    if (onlyForAdmin.includes(to.name as string) && ! adminStore.isAdmin) {
        return false;
    }
});

export default router;