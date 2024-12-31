<script setup lang="ts">
import { onMounted, ref, useTemplateRef } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const waiting = ref(false);

const filmId = ref<number | null>(null);
const title = ref('');
const imageUrl = ref('');
const description = ref('');

const snackbarFilmCreatedOpen = ref(false);

const form = useTemplateRef('form');
const route = useRoute();
const router = useRouter();

onMounted(async () => {
    const response = await fetch('http://localhost:8000/api/films/' + route.params.id);
    const data = await response.json();

    filmId.value = data.id;
    title.value = data.title;
    description.value = data.description;
    imageUrl.value = data.image_url;
});


const rules = {
    title: [
        (val: string) => {
            if (val.length < 5) {
                return 'Заголовок должен быть больше 5 символов'
            }

            return true;
        }
    ],
    imageUrl: [
        (val: string) => {
            if (! val) {
                return 'Укажите изображение';
            }

            return true;
        }
    ],
    description: [
        (val: string) => {
            if (val.length < 10) {
                return 'Описание должно быть больше 10 символов'
            }

            return true;
        }
    ]
};

const handleSubmit = async () => {
    waiting.value = true;

    const templateForm = form.value as any;
    const { valid } = await templateForm.validate();

    if (! valid) {
        return;
    }
    
    const response = await fetch('http://localhost:8000/api/films/' + filmId.value, {
        method: 'PUT',
        headers: {
            Accept: 'application/json'
        },
        body: JSON.stringify({
            title: title.value.trim(),
            description: description.value.trim(),
            imageUrl: imageUrl.value.trim()
        }),
        credentials: 'include'
    });

    if (response.ok) {
        router.push({ name: 'films.show', params: { id: filmId.value } });
        
        templateForm.reset();
        snackbarFilmCreatedOpen.value = true;
    }
    waiting.value = false;
};
</script>

<template>
    <v-btn :to="{ name: 'films.show', params: { id: filmId } }" color="primary">
        <v-icon
          icon="mdi-arrow-left"
          start
        ></v-icon>
        Назад
    </v-btn>

    <h1 class="mb-3">Изменение фильма</h1>

    <v-form ref="form" @submit.prevent="handleSubmit">
        <v-text-field
            v-model="title"
            :rules="rules.title"
            label="Заголовок"
            class="mb-3"
        />

        <v-text-field
            v-model="imageUrl"
            :rules="rules.imageUrl"
            label="Изображение"
            class="mb-3"
        />

        <v-textarea
            v-model="description"
            :rules="rules.description"
            label="Описание"
            class="mb-3"
        />

        <v-btn
            :loading="waiting"
            color="primary"
            type="submit"
        >
            Изменить фильм
        </v-btn>
    </v-form>

    <v-snackbar
      v-model="snackbarFilmCreatedOpen"
      :timeout="2000"
      color="primary"
      elevation="24"
    >
        <p>Фильм успешно обновлён!</p>
    </v-snackbar>
</template>