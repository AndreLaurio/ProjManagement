<template>
    <v-app class="main-page">
        <ExamineeNavbar v-if="this.$route.name === 'ExaminationRoom'" />
        <ExaminerNavbar
            v-if="
                ['ManageRoom', 'ManageExam', 'CreateExam'].includes(
                    this.$route.name
                )
            "
        />
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
import ExaminerNavbar from "./components/ExaminerNavbar";
export default {
    components: {
        ExamineeNavbar,
        ExaminerNavbar
    }
};
</script>
