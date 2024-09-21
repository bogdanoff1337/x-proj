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

import TelegramIcon from '../../svg/telegram.svg?component';
import BonusIcon from '../../svg/bonus.svg?component';
import PlusIcon from '../../svg/plus.svg?component';
import ExitIcon from '../../svg/exit.svg?component';

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
    <header class="header">
        <div class="header__container">
            <div class="header__left">
                <a href="/" class="header__logo">
                    <h1 class="header__title">X-PROJ</h1>
                </a>
                <nav v-if="!isMobile" class="header__nav">
                    <a href="https://t.me/bogdanoff1337" class="header__link">
                        <TelegramIcon class="header__icon"/>
                    </a>
                    <a href="/bonus" class="header__link">
                        <BonusIcon class="header__icon"/>
                        <span class="header__referral">Bonus</span>
                    </a>
                </nav>
            </div>
            <div class="header__right">
                <nav class="header__nav">
                    <template v-if="isLoading">
                        <span>Loading...</span>
                    </template>

                    <template v-else-if="isAuthenticated">
                        <a href="/deposit" class="header__link">
                            <span class="header__deposit">{{ user.money + '$' }}</span>
                            <PlusIcon class="header__icon"/>
                        </a>

                        <router-link to="/profile" class="header__link">
                            <img :src="user.avatar" alt="User" class="header__avatar" />
                        </router-link>

                        <a v-if="!isMobile" @click.prevent="logout" class="header__link">
                            <ExitIcon class="header__icon"/>
                        </a>

                        <Burger v-else @logout="logout" />
                    </template>

                    <template v-else>
                        <button @click.prevent="login" class="header__button">Authorization</button>
                    </template>
                </nav>
            </div>
        </div>
    </header>
</template>

<style scoped lang="scss">
.header {
    padding: 10px 0;

    &__container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 2100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    &__icon {
        width: 35px;
        height: 35px;
    }

    &__left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    &__logo {
        text-decoration: none;
    }

    &__title {
        color: #fff;
        margin: 0;
        font-size: 26px;
    }

    &__link {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    &__nav {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    &__referral {
        color: #fff;
        font-size: 22px;
        margin-top: 12px;
    }

    &__right {
        display: flex;
        align-items: center;
    }

    &__avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    &__deposit {
        margin-right: 15px;
        color: #fff;
        font-size: 22px;
    }

    &__button {
        background-color: #bd63bc;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        &__avatar, &__icon {
            width: 25px;
            height: 25px;
        }

        &__deposit {
            font-size: 18px;
        }

        &__nav {
            gap: 10px;
        }

        &__left img {
            width: 25px;
            height: 25px;
        }

        &__button {
            padding: 8px 16px;
        }
    }
}
</style>
