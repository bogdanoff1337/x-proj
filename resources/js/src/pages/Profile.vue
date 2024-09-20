<script setup>
import Container from "../../Components/Container.vue";
import Tabs from "../../Components/Tabs.vue";
import {useUserStore} from '../hooks/store/useUserStore.js';

const userStore = useUserStore();
import SuccessIcon from "../../../svg/success.svg?component";
import ExitIcon from "../../../svg/exit.svg?component";

</script>

<template>
    <Container>
        <Tabs/>
        <div class="main-info">
            <img :src="userStore.user.avatar" alt="User Avatar" class="avatar"/>
            <div class="main-info__user">
                <p class="main-info__nickname">{{ userStore.user.nickname }}</p>
                <div class="trade-input">
                    <input
                        v-model="userStore.user.trade_url"
                        placeholder="Trade URL"
                        class="trade-input__input"
                    />
                    <button class="trade-input__button" @click="userStore.saveTradeUrl">
                        <SuccessIcon class="trade-input__icon"/>
                    </button>
                </div>
            </div>
            <button @click="userStore.logout">
                <ExitIcon class="icon"/>
            </button>
        </div>
    </Container>
</template>

<style scoped lang="scss">
.main-info {
    padding: 1.25em;
    border-radius: 0.625em;
    background-color: #8561a6;
    color: white;
    display: flex;
    align-items: center;

    &__user {
        margin-left: 1.25em;
        margin-right: 1.25em;
        display: flex;
        flex-direction: column;
    }

    &__nickname {
        font-size: 1.5em;
        margin: 0;
        margin-bottom: 0.3125em;
    }
}

.avatar {
    width: 6.25em;
    height: 6.25em;
    border-radius: 50%;
}

@media (max-width: 768px) {
    .main-info__nickname {
        font-size: 1.25em;
    }

    .avatar {
        width: 5em;
        height: 5em;
    }
}

@media (max-width: 480px) {
    .main-info__nickname {
        font-size: 1em;
    }

    .avatar {
        width: 4em;
        height: 4em;
    }
}


.trade-input {
    display: flex;
    width: 100%;
    &__button {
        background: #2d3748;
        border-bottom-right-radius: 0.25em;
        border-top-right-radius: 0.25em;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;

        &:hover {
            background: #4a5568;
            .trade-input__icon {
                color: white;
            }
        }
    }

    &__icon {
        transition: color 0.3s ease;
        color: #00bb00;
        width: 1.25em;
        height: 1.25em;
        cursor: pointer;
    }

    &__input {
        width: 100%;
        padding: 0.3125em;
        border-bottom-left-radius: 0.25em;
        border-top-left-radius: 0.25em;
        border: none;
        outline: none;
    }
}

button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    margin-left: auto;
}

.icon {
    width: 1.875em;
    height: 1.875em;
    cursor: pointer;
}
</style>
