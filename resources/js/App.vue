<template>
    <v-app class="main-page">
        <ExamineeNavbar v-if="this.$route.name === 'ExaminationRoom'" />
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<style scoped>
.main-page {
    background-color: #f5f5f5;
}
</style>

<script>
import ExamineeNavbar from "./components/ExamineeNavbar";
export default {
    components: {
        ExamineeNavbar
    }
};
</script>
