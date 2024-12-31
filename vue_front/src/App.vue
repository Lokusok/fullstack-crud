<script setup lang="ts">
import { ref } from 'vue';

const drawer = ref(false);

const items = [
  {
    title: 'Все фильмы',
    props: {
      to: '/',
      prependIcon: 'mdi-account-multiple'
    }
  },
  {
    title: 'Добавить фильм',
    props: {
      to: '/films/create',
      prependIcon: 'mdi-grid'
    }
  },
];
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