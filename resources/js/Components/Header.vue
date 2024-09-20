<script setup>

import Burger from './Burger.vue';
import { ref, onMounted } from 'vue';
import { useMediaQuery } from '@vueuse/core';
import axios from 'axios';

const user = ref(null);
const isAuthenticated = ref(false);
const error = ref(null);
const isLoading = ref(true);
const isMobile = useMediaQuery('(max-width: 768px)');

const login = () => {
    window.open('auth/steam', '_blank');
};

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
   margin: 0;
   padding: 0;
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
}

.left h1 {
    color: #fff;
    margin: 0;
    font-size: 26px;
}

.left a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.left nav {
    display: flex;
    align-items: center;
    gap: 10px;
}

.left span {
    color: #fff;
    font-size: 22px;
}

.left img {
    width: 35px;
    height: 35px;
    color: #0000cc;
}

.left .referral {
    margin-top: 12px;
}

.right {
    display: flex;
    align-items: center;
}

.right nav {
    align-items: center;
    display: flex;
    gap: 20px;
}

.right a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.right span {
    color: #fff;
    font-size: 22px;
}

.right .avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.right .exit-icon {
    width: 30px;
    height: 30px;
    border-radius: 0;
}

.right .income {
    width: 35px;
    height: 35px;
    border-radius: 0;
}

.right .deposit {
    margin-right: 15px;
}

.burger-icon {
    width: 35px;
    height: 35px;
    cursor: pointer;
}

button {
    background-color: #bd63bc;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
