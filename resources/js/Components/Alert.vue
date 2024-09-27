<script setup>
import {ref, watch, provide} from 'vue';

const error = ref(null);
const setError = (err) => {
    error.value = err;
};

watch(error, (newError) => {
    if (newError) {
        setTimeout(() => {
            error.value = null;
        }, 5000);
    }
});

provide('setError', setError);
</script>

<template>
    <div v-if="error" class="alert" @click="error = null">
        {{ error }}
        <button class="close-button" @click.stop="error = null">✖</button>
    </div>
</template>

<style scoped>
.alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #f8d7da;
    color: #721c24;
    padding: 1em;
    border-radius: 0.25em;
    margin: 1em 0;
    border: 1px solid #f5c6cb;
    z-index: 1000;
    transition: opacity 0.3s ease-in-out;
}

.close-button {
    margin-left: 10px;
    border: none;
    background: transparent;
    color: #721c24;
    cursor: pointer;
}
</style>
