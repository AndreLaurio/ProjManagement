<template>
    <div class="mt-5 ml-5 font-body">
        <h1 class="mb-3">Examination Room</h1>
        <v-divider class="mr-10"></v-divider>
        <div class="mt-5 mr-10">
            <v-dialog v-model="joinDialog" persistent max-width="550">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        class="primary text-uppercase"
                        dark
                        v-on="on"
                        v-bind="attrs"
                    >
                        Join Room</v-btn
                    >
                </template>
                <v-card class="font-body">
                    <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                        <span class="text-center text-uppercase register-title"
                            >Join Room</span
                        >
                    </v-card-title>
                    <v-card-text>
                        <div class="ml-8 mr-8">
                            <label for="join-room-code" class="text-md-body-1">
                                Room Code</label
                            >
                            <v-text-field
                                outlined
                                clearable
                                id="join-room-code"
                                v-model="room_code"
                            ></v-text-field>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <div class="mb-2">
                            <v-btn
                                dark
                                outlined
                                class="text-uppercase primary"
                                @click="joinRoom"
                            >
                                Join Room
                            </v-btn>
                            <v-btn
                                outlined
                                color="indigo"
                                @click="joinDialog = false"
                                class="text-uppercase"
                            >
                                Close
                            </v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-card
                flat
                class="project-border mt-3 font-body"
                v-for="room in rooms"
                :key="room.id"
            >
                <v-card-text>
                    <div class="pl-5">
                        <v-layout>
                            <v-flex md8>
                                <h2 class="black--text">
                                    {{ room.room_title }}
                                </h2>
                                <br />
                                <span>{{ room.room_desc }}</span>
                            </v-flex>
                            <v-flex md4>
                                <div class="text-right">
                                    <span>There is 1 unanswered exam</span>
                                    <br />
                                    <v-btn
                                        outlined
                                        color="indigo"
                                        class="pl-12 pr-12 mt-8 rounded-lg"
                                        @click="showRoomExam(room.room_id)"
                                    >
                                        Enter
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
            rooms: [],
            items: [{ title: "Leave Room" }],
            room_code: "",
            joinDialog: false,
            user_id: ""
        };
    },
    mounted() {
        this.getUserDetail();
        this.getExamineeRoom();
    },
    methods: {
        joinRoom() {
            axios
                .post("api/join-room", {
                    room_code: this.room_code,
                    examinee_id: this.user_id
                })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.log("errror");
                });
        },
        getExamineeRoom() {
            axios.get("api/user").then(response => {
                this.user_id = response.data.user_id;

                var examinee_id = this.user_id;
                axios
                    .get(`api/examinee-rooms/${examinee_id}`)
                    .then(response => {
                        this.rooms = response.data;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log("error");
                    });
            });
        },
        getUserDetail() {
            axios.get("api/user").then(response => {
                this.user_id = response.data.user_id;
            });
        },
        showRoomExam(room_id) {
            this.$router.push({
                name: "RoomExam",
                params: {
                    id: room_id
                }
            });
        }
    }
};
</script>
