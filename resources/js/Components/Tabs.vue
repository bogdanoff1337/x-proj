<template>
    <div class="tabs-container">
        <ul class="tabs">
            <li v-for="tab in tabs" :key="tab.route"
                :class="{ active: activeTab === tab.route }">
                <router-link :to="tab.route" @click.native="setActiveTab(tab.route)">
                    {{ tab.name }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {ref, watch} from 'vue';
import {useRoute} from 'vue-router';

const route = useRoute();

const tabs = ref([
    {name: 'Profile',   route: '/profile'},
    {name: 'Statistic', route: '/statistic'},
    {name: 'Referrals', route: '/referrals'},
    {name: 'Settings',  route: '/settings'},
]);

const activeTab = ref(route.path);

const setActiveTab = (route) => {
    activeTab.value = route;
};

watch(route, (newRoute) => {
    activeTab.value = newRoute.path;
});
</script>

<style scoped>
.tabs-container {
    margin-bottom: 20px;
    overflow-x: auto;
    border-radius: 10px;
    background-color: #8561a6;
}

.tabs {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.tabs li {
    flex: 1;
    text-align: center;
    padding: 10px 15px;
    cursor: pointer;
    color: white;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, transform 0.3s;
}

.tabs li.active {
    background-color: #f2f2f2;
    color: #8561a6;
}

.tabs li a {
    text-decoration: none;
    color: inherit;
    display: block;
    width: 100%;
}

.tabs li:first-child {
    border-radius: 10px 0 0 10px;
}

.tabs li:last-child {
    border-radius: 0 10px 10px 0;
}

.tabs li:last-child.active {
    background-color: #f2f2f2;
}

@media (max-width: 768px) {
    .tabs {
        flex-direction: row;
    }
}
</style>
