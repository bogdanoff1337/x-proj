<script setup>
import Container from "../../Components/Container.vue";
import Tabs from "../../Components/Tabs.vue";
import Profile from '../../Components/Profile/Profile.vue';
import Inventory from "../../Components/Profile/Inventory.vue";

</script>

<template>
    <Container>
        <div class="profile-main">
            <Tabs/>
            <Profile/>
        </div>
        <Inventory/>
    </Container>
</template>

<style scoped lang="scss">
.profile-main {
    box-sizing: border-box;
    background: #3A004E;
}
</style>
