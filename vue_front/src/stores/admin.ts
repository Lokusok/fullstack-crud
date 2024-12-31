import { defineStore } from "pinia";

export const useAdminStore = defineStore('adminStore', {
    state: () => ({
        isAdmin: false
    }),
    actions: {
        setAdmin(val: boolean) {
            this.isAdmin = val;
        }
    }
});

