<template>
    <div class="mt-5">
        <v-divider></v-divider>
        <div class="ml-12 mt-5 mb-5">
            <h1>{{ room_details.room_title }}</h1>
            <h2 class="grey--text">
                {{ room_details.first_name }} {{ room_details.last_name }}
            </h2>
            <span class="text-lg-h6"> {{ room_details.room_desc }}</span>
        </div>
        <v-divider></v-divider>
        <div>
            <v-card flat class="project-border mt-3 ml-5 mr-5 font-body">
                <v-card-text>
                    <div class="pl-5">
                        <v-layout>
                            <v-flex md8>
                                <h2 class="black--text">Midterm Exam</h2>
                                <br />
                                <span
                                    >Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit
                                    esse cillum dolore eu fugiat nulla
                                    pariatur.</span
                                >
                            </v-flex>
                            <v-flex md4>
                                <div class="text-right">
                                    <span>There is 1 unanswered exam</span>
                                    <br />
                                    <v-btn
                                        outlined
                                        color="indigo"
                                        class="pl-12 pr-12 mt-12 rounded-lg"
                                        @click="takeExamination"
                                    >
                                        Take
                                    </v-btn>
                                </div>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
.font-body {
    font-family: "Poppins", sans-serif;
}
.project-border {
    border-left: 8px solid #221c92;
}
</style>

<script>
export default {
    data() {
        return {
            room_details: []
        };
    },
    mounted() {
        this.getRoomDetail();
        this.getUserDetail();
    },
    methods: {
        getUserDetail() {
            axios.get("api/user").then(response => {});
        },
        getRoomDetail() {
            var room_id = this.$route.params.id;
            axios.get(`api/room-details/${room_id}`).then(response => {
                this.room_details = response.data[0];
                console.log(response.data);
            });
        },
        takeExamination() {
            var room_id = this.$route.params.id;
            this.$router.push({
                name: "TakeExam",
                params: {
                    id: room_id
                }
            });
        }
    }
};
</script>
