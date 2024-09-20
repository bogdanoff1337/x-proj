<script setup>
import { ref } from 'vue';

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
    <div>
        <div class="burger-icon" @click="toggleMenu">
            <span :class="{ open: isMenuOpen }"></span>
            <span :class="{ open: isMenuOpen }"></span>
            <span :class="{ open: isMenuOpen }"></span>
        </div>

        <div v-if="isMenuOpen" class="modal-overlay" @click.self="toggleMenu">
            <nav class="menu-content">
                <a href="/profile">Profile</a>
                <a href="/inventory">Inventory</a>
                <a href="/bonus">
                    <img src="../../svg/bonus.svg" alt="Bonus" class="bonus-icon" />
                </a>
                <a @click.prevent="$emit('logout')">
                    <img src="../../svg/exit.svg" alt="Exit" class="exit-icon" />
                </a>
            </nav>
        </div>
    </div>
</template>

<style scoped>
.burger-icon {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 25px;
    cursor: pointer;
}

.burger-icon span {
    display: block;
    width: 100%;
    height: 3px;
    background-color: #fff;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.burger-icon span.open:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.burger-icon span.open:nth-child(2) {
    opacity: 0;
}

.burger-icon span.open:nth-child(3) {
    transform: rotate(-45deg) translate(10px, -10px);
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.menu-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
    background-color: #8561a6;
    padding: 40px;
    border-radius: 10px;
}

.menu-content a {
    color: #fff;
    text-decoration: none;
    font-size: 24px;
    text-align: center;
    padding: 10px;
    border-bottom: 1px solid #fff;
}

.menu-content .exit-icon, .bonus-icon {
    width: 30px;
    height: 30px;
}

.menu-content a:last-child {
    border-bottom: none;
}

.modal-overlay {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
