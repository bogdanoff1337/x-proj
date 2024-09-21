import { defineStore } from 'pinia';
import axios from 'axios';
export const useUserStore = defineStore('user', {
    state: () => ({
        user: {
            id: null,
            trade_url: '',
            avatar: '',
        },
        isAuthenticated: false,
        error: null,
    }),
    actions: {
        setUser(data) {
            this.user = data;
            this.isAuthenticated = true;
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        },
        async saveTradeUrl() {
            try {
                const response = await axios.post('/api/user/trade-url', {
                    user_id: this.user.id,
                    trade_url: this.user.trade_url
                });

                console.log('Trade URL updated:', response.data);
            } catch (error) {
                console.error(error);
            }
        },

        setError(err) {
            this.error = err;
        },
    },
});
