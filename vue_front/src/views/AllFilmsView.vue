<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { TFilm } from '../types/films';

const initialLoading = ref(true);
const loading = ref(true);

const films = ref<TFilm[]>([]);
const searchQuery = ref('');

const isSearchBtnDisabled = computed(() => {
    return searchQuery.value === '';
});

const apiCalls = {
    async getFilms() {
        const response = await fetch('http://localhost:8000/api/films');
        const data = await response.json();

        films.value = data;
    },

    async getFilmsBy(query: string) {
        const response = await fetch('http://localhost:8000/api/films/search?q=' + query)
        const data = await response.json();

        films.value = data;
    }
};

onMounted(async () => {
    await apiCalls.getFilms();
    initialLoading.value = false;
    loading.value = false;
});

const handleSearchClick = async () => {
    apiCalls.getFilmsBy(searchQuery.value.trim().toLowerCase());
};

const handleSearchClear = async () => {
    searchQuery.value = '';

    apiCalls.getFilms();
};

const handleSearchInput = async () => {
    if (searchQuery.value.trim() !== '') {
        return;
    }

    apiCalls.getFilms();
};
</script>

<template>
    <h1 class="mb-3">Все фильмы</h1>

    <form @submit.prevent="handleSearchClick">
        <v-row class="ga-5">
            <template v-if="initialLoading">
                <v-skeleton-loader
                    width="90%"
                    height="40"
                />

                <v-skeleton-loader
                    class="mt-1"
                    width="95"
                    height="36"
                />
            </template>

            <template v-else>
                <v-text-field
                    v-model="searchQuery"
                    label="Поиск по названию"
                    clearable
                    @click:clear="handleSearchClear"
                    @input="handleSearchInput"
                >
                </v-text-field>
                <div class="py-3">
                    <v-btn
                        :disabled="isSearchBtnDisabled"
                        color="primary"
                        type="submit"
                        @click="handleSearchClick"
                    >
                        Искать
                    </v-btn>
                </div>
            </template>
        </v-row>
    </form>

    <v-row class="mt-4" v-if="films">
        <template v-if="loading">
            <v-col
                v-for="n in 6"
                :key="n"
                cols="12"
                sm="4"
            >
                <v-skeleton-loader
                    width="370"
                    height="300"
                />
            </v-col>
        </template>

        <template v-else>
            <v-col
                v-for="film in films"
                :key="film.id"
                cols="12"
                sm="4"
            >
                <v-card
                    color="blue-grey-lighten-5"
                >
                    <v-img
                        height="150"
                        :src="film.image_url"
                        cover
                    ></v-img>

                    <v-card-item>
                        <v-card-title>{{ film.title }}</v-card-title>
                    </v-card-item>

                    <v-card-text class="p-0">
                        <div>{{ film.description }}</div>
                    </v-card-text>

                    <v-divider class="mx-4 mb-1"></v-divider>

                    <v-card-item>
                        <v-btn :to="`/films/${film.id}`" color="primary">Перейти на страницу фильма</v-btn>
                    </v-card-item>
                </v-card>
            </v-col>
        </template>
    </v-row>
</template>