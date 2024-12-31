<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { TFilm } from '../types/films';
import { useAdminStore } from '../stores/admin';

const waitingDelete = ref(false);

const film = ref<TFilm | null>(null);
const router = useRouter();
const route = useRoute();

const adminStore = useAdminStore();

onMounted(async () => {
    const response = await fetch('http://localhost:8000/api/films/' + route.params.id);
    const data = await response.json();

    film.value = data;
});

const deleteFilm = async () => {
    waitingDelete.value = true;

    const response = await fetch('http://localhost:8000/api/films/' + route.params.id, {
        method: 'DELETE',
        credentials: 'include'
    });

    if (response.ok) {
        router.replace({ name: 'films.index' });
    }

    waitingDelete.value = true;
};
</script>

<template>
    <v-btn :to="{ name: 'films.index' }" color="primary">
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
        
        <template v-if="adminStore.isAdmin">
            <v-divider class="my-3"></v-divider>
            
            <div class="d-flex ga-3">
                <v-btn :to="{ name: 'films.edit', params: { id: film.id } }" color="secondary">
                    <v-icon icon="mdi-brush" start />
                    Перейти к редактированию
                </v-btn>
    
                <v-dialog max-width="500">
                    <template v-slot:activator="{ props: activatorProps }">
                        <v-btn
                            v-bind="activatorProps"
                            color="red"
                            text="Удалить"
                        />
                    </template>

                    <template v-slot:default="{ isActive }">
                        <v-card title="Подтверждение">
                        <v-card-text>
                            Вы уверены, что хотите удалить данный фильм?
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                text="Отмена"
                                @click="isActive.value = false"
                            />
                            <v-btn
                                color="red"
                                text="Удалить"
                                :loading="waitingDelete"
                                @click="deleteFilm"
                            />
                        </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>
            </div>
        </template>
    </template>
</template>