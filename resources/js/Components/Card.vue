<script setup>
import { defineProps } from 'vue';
import {useInventoryStore} from "../src/hooks/store/useInventoryStore.js";

const inventoryStore = useInventoryStore();

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="card">
        <img :src="item.icon_url" alt="User Avatar" class="card__avatar" />
        <div class="card__info">
            <div v-if="item.stickers && item.stickers.length > 0" class="stickers">
                <img v-for="sticker in item.stickers" :key="sticker.label" :src="sticker.image" :alt="sticker.label" />
            </div>
            <p class="card__nickname">{{ item.name }}</p>
            <p class="card__price">{{ item.price }}</p>
        </div>
        <button class="load-price-button" @click="inventoryStore.getPrice(item.market_hash_name)">Get price</button>
    </div>
</template>

<style scoped lang="scss">
.card {
    padding: 1em;
    border-radius: 0.625em;
    background-color: #8561a6;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    height: 150px;
    overflow: hidden;
    position: relative;
    transition: background-color 0.3s ease; /* Smooth darken transition */

    /* Darken the card on hover */
    &:hover {
        background-color: rgba(0, 0, 0, 0.6);
    }

    &:hover .load-price-button {
        display: block;
    }

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

.card__avatar {
    width: 5em;
    height: 4em;
    border-radius: 0.5em;
    background: #8561a6;
}

/* Center the button in the middle of the card */
.load-price-button {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #1a202c;
    color: white;
    border: none;
    padding: 0.5em 1em;
    border-radius: 0.625em;
    cursor: pointer;
    z-index: 1; /* Ensure it stays on top */
}
</style>
