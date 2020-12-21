<template>
    <v-container class="mt-12 font-body" justify="center">
        <v-card width="550" class="rounded-lg pl-5 pr-5 mx-auto middle-card">
            <v-card-title>
                <h3>Examination Title 1</h3>
                <h2>Engr. Joshua Mamangun</h2>
            </v-card-title>
            <v-card-text>
                <span class="text-md-body-1">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur.
                </span>
                <v-divider class="ml-5 mr-5 mt-5 mb-5"></v-divider>
                <div class="font-weight-bold black--text">
                    <v-layout>
                        <v-flex>Open At:</v-flex>
                        <v-flex>Today/ 10:00 AM</v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex>Close At:</v-flex>
                        <v-flex>Today/ 10:00AM</v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex>Total Items : </v-flex>
                        <v-flex>100</v-flex>
                    </v-layout>
                    <v-layout>
                        <v-flex>Time Limit :</v-flex>
                        <v-flex>1 hour</v-flex>
                    </v-layout>
                </div>
            </v-card-text>
            <v-card-actions class="justify-center">
                <div class="mb-2">
                    <v-btn
                        color="indigo"
                        outlined
                        class="rounded-lg pl-12 pr-12"
                        @click="takeExam"
                        >Take</v-btn
                    >
                </div>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
.font-body {
    font-family: "Poppins", sans-serif;
}

.middle-card {
    border-top: 8px solid #221c92;
}
</style>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        this.getExamDetails();
    },
    methods: {
        getExamDetails() {
            console.log(this.$route.params.id);
        },
        takeExam() {
            var exam_id = this.$route.params.id;

            this.$router.push({
                name: "TakingExam",
                id: exam_id
            });
        }
    }
};
</script>
