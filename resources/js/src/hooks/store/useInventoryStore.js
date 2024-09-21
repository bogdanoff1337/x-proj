import {defineStore} from 'pinia';
import axios from 'axios';

export const useInventoryStore = defineStore('item', {
    state: () => ({
        items: [
            {
                stickers: {
                    image: '',
                    label: '',
                }
            }
        ],
        error: null,
    }),
    actions: {
        async fetchItems(userId) {
            try {
                const response = await axios.get(`api/inventory/${userId}`);
                this.items = response.data;
                return this.items;
            } catch (err) {
                this.setError(err);
                return [];
            }
        },
        setError(err) {
            this.error = err;
        },
    },
});
