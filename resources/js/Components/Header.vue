<script setup>

import Burger from './Burger.vue';
import { ref, onMounted } from 'vue';
import { useMediaQuery } from '@vueuse/core';
import { useUserStore } from '../src/hooks/store/useUserStore';
import axios from 'axios';

const user = ref(null);
const isAuthenticated = ref(false);
const error = ref(null);
const isLoading = ref(true);

const isMobile = useMediaQuery('(max-width: 768px)');

const login = () => {
    window.open('auth/steam', '_blank');
};

const userStore = useUserStore();

const logout = async () => {
    try {
        await axios.post('auth/logout');
        user.value = null;
        isAuthenticated.value = false;
    } catch (err) {
        error.value = err.response ? err.response.data : err.message;
    }
};

const checkAuth = async () => {
    try {
        const res = await axios.get('auth/user');
        user.value = res.data.data;
        userStore.setUser(res.data.data);
        isAuthenticated.value = true;
    } catch (err) {
        isAuthenticated.value = false;
        error.value = err.response ? err.response.data : err.message;
    } finally {
        isLoading.value = false;
    }
};

onMounted(checkAuth);
</script>

<template>
    <header>
        <div class="container">
            <div class="left">
                <a href="/">
                    <h1>X-PROJ</h1>
                </a>
                <nav v-if="!isMobile">
                    <a href="https://t.me/bogdanoff1337">
                        <img src="../../svg/telegram.svg" alt="Telegram" />
                    </a>

                    <a href="/bonus">
                        <img src="../../svg/bonus.svg" alt="Bonus" />
                        <span class="referral">Bonus</span>
                    </a>
                </nav>
            </div>
            <div class="right">
                <nav>
                    <template v-if="isLoading">
                        <span>Loading...</span>
                    </template>

                    <template v-else-if="isAuthenticated">
                        <a href="/deposit">
                            <span class="deposit">{{ user.money + '$' }}</span>
                            <img src="../../svg/plus.svg" alt="Income" class="income" />
                        </a>

                        <router-link to="/profile">
                            <img :src="user.avatar" alt="User" class="avatar" />
                        </router-link>

                        <a v-if="!isMobile" @click.prevent="logout">
                            <img src="../../svg/exit.svg" alt="Exit" class="exit-icon" />
                        </a>

                        <Burger v-else @logout="logout" />
                    </template>

                    <template v-else>
                        <button @click.prevent="login">Authorization</button>
                    </template>
                </nav>
            </div>
        </div>
    </header>
</template>

<style scoped>
header {
    padding: 10px 0;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-sizing: content-box;
    max-width: 2100px;
    margin: 0 auto;
    padding: 0 20px;
}

.left {
    display: flex;
    align-items: center;
    gap: 20px;

    h1 {
        color: #fff;
        margin: 0;
        font-size: 26px;
    }

    a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    nav {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    span {
        color: #fff;
        font-size: 22px;
    }

    img {
        width: 35px;
        height: 35px;
        color: #0000cc;
    }

    .referral {
        margin-top: 12px;
    }
}

.right {
    display: flex;
    align-items: center;

    nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    span {
        color: #fff;
        font-size: 22px;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .exit-icon,
    .income {
        width: 35px;
        height: 35px;
        border-radius: 0;
    }

    .deposit {
        margin-right: 15px;
    }
}

button {
    background-color: #bd63bc;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .right {
        .avatar,
        .income,
        .exit-icon {
            width: 25px;
            height: 25px;
        }

        .deposit {
            font-size: 18px;
        }

        nav {
            gap: 10px;
        }
    }

    .left {
        img {
            width: 25px;
            height: 25px;
        }
    }

    button {
        padding: 8px 16px;
    }
}

</style>

