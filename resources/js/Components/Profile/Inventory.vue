<script setup>
import {ref, watch } from 'vue';
import {useInventoryStore} from "../../src/hooks/store/useInventoryStore.js";
import {useUserStore} from "../../src/hooks/store/useUserStore.js";

const inventoryStore = useInventoryStore();
const loading = ref(true);
const items = ref([]);
const userStore = useUserStore();
const userId = ref(userStore.user.id);

watch(() => userStore.user.id, async (newId) => {
    if (newId) {
        loading.value = true;
        items.value = await inventoryStore.fetchItems(newId);
        console.log(items.value);
        loading.value = false;
    }
}, { immediate: true });
</script>

<template>
    <div class="grid-container">
        <div
            v-if="loading"
            class="skeleton-card"
            v-for="index in 6"
            :key="index"
        >
            <div class="skeleton-avatar"></div>
            <div class="skeleton-info">
                <div class="skeleton-name"></div>
                <div class="skeleton-price"></div>
            </div>
        </div>

        <div
            v-else
            v-for="item in items"
            :key="item.name"
            class="card"
        >
            <img :src="item.icon_url" alt="User Avatar" class="card__avatar"/>
            <div class="card__info">
                <div class="stickers">
                    <img
                        v-for="sticker in item.stickers"
                        :key="sticker.label"
                        :src="sticker.image"
                        :alt="sticker.label"
                    />
                </div>
                <p class="card__nickname">{{ item.name }}</p>
                <p class="card__price">{{ item.price }}</p>
            </div>
        </div>
    </div>
</template>


<style scoped lang="scss">
.grid-container {
    background: #1a202c;
    border-radius: 0.625em;
    padding: 20px;
    display: grid;
    margin-top: 10px;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1em;
    max-width: 100%;
}

.card, .skeleton-card {
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

    .card__info {
        display: flex;
        flex-direction: column;
        align-items: center;

        .card__nickname {
            font-size: 0.7em;
            margin: 0;
            margin-bottom: 0.3125em;
            margin-top: 5px;
        }
        .card__price {
            font-size: 1em;
            margin: 0;
            margin-top: 5px;
        }

    }

    .stickers {
        display: flex;
        justify-content: center;
        margin-top: 5px;

        img {
            width: 32px;
            height: 24px;
            margin: 0 2px;
        }
    }
}

.card__avatar, .skeleton-avatar {
    width: 5em;
    height: 4em;
    border-radius: 0.5em;
    background: #8561a6;
}

.skeleton-card {
    background-color: #4a5568;
    animation: pulse 1.5s infinite;
}

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
