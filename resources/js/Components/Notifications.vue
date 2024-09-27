<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useUserStore } from '../src/hooks/store/useUserStore';

const userStore = useUserStore();
const isShaking = ref(false);
import NotificationIcon from "../../svg/notification.svg";
import NotificationHasIcon from "../../svg/notification-have.svg";

onMounted(() => {
    const interval = setInterval(() => {
        isShaking.value = true;
        setTimeout(() => {
            isShaking.value = false;
        }, 500);
    }, 3000);

    onUnmounted(() => {
        clearInterval(interval);
    });
});
</script>

<template>
    <NotificationHasIcon
        v-if="userStore.user.notify"
        :class="['header__icon', { shake: isShaking }]"
    />
    <NotificationIcon v-else class="header__icon" />
</template>

<style scoped>
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.5s ease-in-out infinite;
}
</style>
