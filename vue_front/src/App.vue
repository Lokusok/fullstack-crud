<script setup lang="ts">
import { ref, watch } from 'vue';
import { useAdminStore } from './stores/admin';

const drawer = ref(false);

const items = ref([
  {
    title: 'Все фильмы',
    props: {
      to: '/',
      prependIcon: 'mdi-account-multiple'
    }
  },
]);

const adminStore = useAdminStore();

watch(() => adminStore.isAdmin, () => {
  if (items.value.some((item) => item.title === 'Добавить фильм')) {
    return;
  }

  if (! adminStore.isAdmin) {
    const isAdmin = localStorage.getItem('is_admin');

    if (isAdmin) {
      adminStore.setAdmin(true);
    }
  }

  if (adminStore.isAdmin) {
    items.value.push({
      title: 'Добавить фильм',
      props: {
        to: '/films/create',
        prependIcon: 'mdi-grid'
      }
    });
  }
}, { immediate: true });
</script>

<template>
  <v-layout>
    <v-app-bar
      :elevation="2"
      color="primary"
    >
      <template v-slot:prepend>
        <v-app-bar-nav-icon
          @click.stop="drawer = !drawer"
        />
      </template>

      <v-app-bar-title>Laravel + Vue | simple crud</v-app-bar-title>

      <template v-slot:append>
          <template v-if="!adminStore.isAdmin">
            <v-btn to="/admin/auth" prepend-icon="mdi-account">
              Войти
            </v-btn>
          </template>

          <template v-else>
            <v-btn disabled prepend-icon="mdi-account">
              Успешный вход!
            </v-btn>
          </template>
      </template>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      :location="$vuetify.display.mobile ? 'bottom' : undefined"
      temporary
    >
      <v-list
        :items="items"
      />
    </v-navigation-drawer>

    <v-main>
      <v-container>
        <RouterView />
      </v-container>
    </v-main>
  </v-layout>
</template>