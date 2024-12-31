<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { TFilm } from '../types/films';

const film = ref<TFilm | null>(null);
const route = useRoute()

onMounted(async () => {
    const response = await fetch('http://localhost:8000/api/cinemas/' + route.params.id);
    const data = await response.json();

    film.value = data;
});
</script>

<template>
    <v-btn to="/" color="primary">
        <v-icon
          icon="mdi-arrow-left"
          start
        ></v-icon>
        Назад
    </v-btn>

    <v-divider class="my-4"></v-divider>

    <template v-if="!film">
        <v-skeleton-loader
            class="mb-3"
            height="40"
            width="500"
        />

        <v-skeleton-loader
            class="mb-3"
            height="20"
            width="300"
        />

        <v-skeleton-loader
            height="300"
            width="300"
        />
    </template>

    <template v-if="film">
        <h1>Фильм | {{ film.title }}</h1>
        <p>{{ film.description }}</p>
        <v-img :src="film.image_url" width="300" height="300" cover />
        
        <v-divider class="my-3"></v-divider>
        
        <div class="d-flex ga-3">
            <v-btn color="secondary">
                <v-icon icon="mdi-brush" start />
                Перейти к редактированию
            </v-btn>

            <v-btn color="red">
                <v-icon icon="mdi-delete" start />
                Удалить
            </v-btn>
        </div>
    </template>
</template>