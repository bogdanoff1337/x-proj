import { defineStore } from 'pinia';
import axios from 'axios';
import Alert from '../../../Components/Alert.vue';

export const useUserStore = defineStore('user', {
    state: () => ({
        user: {
            id: null,
            trade_url: '',
            avatar: '',
            notify: false,
            allReadyHaveItems: false,
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
                this.setError(error);
            }
        },
        setError(err) {
            if (err.response && err.response.status === 422) {
                const errorMessage = err.response.data.message || 'An error occurred';
                const errorDetails = err.response.data.errors ? Object.values(err.response.data.errors).flat().join(', ') : '';
                this.error = `${errorMessage}: ${errorDetails}`;
                Alert.methods.setError(this.error);
            } else {
                this.error = null;
            }
        },
    },
});
