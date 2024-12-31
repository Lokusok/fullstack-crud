import { createRouter, createWebHistory } from "vue-router";

import AllFilmsView from "./views/AllFilmsView.vue";
import SingleFilmView from "./views/SingleFilmView.vue";
import CreateFilmView from "./views/CreateFilmView.vue";
import EditFilmView from "./views/EditFilmView.vue";
import AdminAuthView from "./views/AdminAuthView.vue";

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

export default router;