<script setup lang="ts">
import { computed, ref } from 'vue';
import { useAdminStore } from '../stores/admin';
import { useRouter } from 'vue-router';

const loading = ref(false);
const token = ref('');
const router = useRouter();

const adminStore = useAdminStore();

const apiCalls = {
    async authorizeAsAdmin() {
        const response = await fetch('http://localhost:8000/api/admin/auth', {
            method: 'POST',
            headers: {
                'X-TOKEN': '123'
            },
            credentials: 'include'
        });

        if (response.status === 200) {
            localStorage.setItem('is_admin', '1');

            adminStore.setAdmin(true);
            router.replace({ name: 'films.index' });
        }
    }
};

const isSubmitBtnDisabled = computed(() => {
    return token.value.length === 0;
});

const handleSubmit = async () => {
    loading.value = true;
    await apiCalls.authorizeAsAdmin();
    loading.value = false;
};
</script>

<template>
    <h1 class="mb-3">Войти как администратор</h1>

    <form @submit.prevent="handleSubmit">
        <v-text-field
            v-model="token"
            label="Токен"
        >
        </v-text-field>
        <v-btn
            :disabled="isSubmitBtnDisabled"
            :loading="loading"
            type="submit"
            color="primary"
        >
            Войти
        </v-btn>
    </form>
</template>