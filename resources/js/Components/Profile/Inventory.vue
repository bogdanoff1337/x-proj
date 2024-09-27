<script setup>
import { ref, watch } from 'vue';
import { useInventoryStore } from "../../src/hooks/store/useInventoryStore.js";
import { useUserStore } from "../../src/hooks/store/useUserStore.js";
import Card from '../../Components/Card.vue';

const inventoryStore = useInventoryStore();
const loading = ref(true);
const items = ref([]);
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 15,
    total: 0,
    next_page_url: null,
    prev_page_url: null,
});
const userStore = useUserStore();

const loadItems = async (page = 1) => {
    loading.value = true;
    const response = await inventoryStore.fetchItems(userStore.user.id, page);
    items.value = response.data;

    pagination.value = {
        current_page: response.current_page,
        last_page: response.last_page,
        per_page: response.per_page,
        total: response.total,
        next_page_url: response.next_page_url,
        prev_page_url: response.prev_page_url,
    };

    loading.value = false;
};

watch(() => userStore.user.id, async (newId) => {
    if (newId) {
        await loadItems(1);
    }
}, {immediate: true});
</script>

<template>
    <div class="scroll-container">
        <div class="grid-container">
            <div v-if="loading" class="skeleton-card" v-for="index in 6" :key="index">
                <div class="skeleton-avatar"></div>
                <div class="skeleton-info">
                    <div class="skeleton-name"></div>
                    <div class="skeleton-price"></div>
                </div>
            </div>

            <div v-else v-for="item in items" :key="item.name">
                <Card :item="item"/>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.scroll-container {
    position: relative;
    max-height: 100%;
    overflow-y: auto;
}

.grid-container {
    background: #1a202c;
    border-radius: 0.625em;
    padding: 20px;
    display: grid;
    margin-top: 10px;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1em;
    max-width: 100%;
    position: relative;
}

.grid-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 0.625em;
}

.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.inventory__button {
    padding: 10px 20px;
    border-radius: 0.625em;
    background: #1a202c;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 1.2em;
}

.inventory__button:disabled {
    background: #4a5568;
    cursor: not-allowed;
}

.skeleton-card {
    padding: 1em;
    border-radius: 0.625em;
    background-color: #8561a6;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    height: auto;

    .skeleton-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 1em;
    }

    .skeleton-name, .skeleton-price {
        background: #aaa;
        height: 1em;
        width: 70%;
        margin: 0.2em 0;
        border-radius: 0.25em;
    }
}

.skeleton-avatar {
    width: 5em;
    height: 4em;
    border-radius: 0.5em;
    background: #8561a6;
}

@keyframes pulse {
    0% {
        opacity: 0.7;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0.7;
    }
}
</style>
