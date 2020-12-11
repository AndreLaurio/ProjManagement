<template>
    <div class="mt-5 ml-5">
        <h1 class="font-body mb-3">Manage Room</h1>
        <v-divider class="mr-10"></v-divider>
        <div class="mt-5 mr-10">
            <v-dialog v-model="createRoomDialog" persistent max-width="550">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        class="primary text-uppercase"
                        dark
                        v-on="on"
                        v-bind="attrs"
                    >
                        Create Room</v-btn
                    >
                </template>
                <v-card class="font-body">
                    <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                        <span class="text-center text-uppercase register-title"
                            >Create Room</span
                        >
                    </v-card-title>
                    <v-card-text>
                        <div class="ml-8 mr-8">
                            <label
                                for="create-room-title"
                                class="text-md-body-1"
                            >
                                Room Title</label
                            >
                            <v-text-field
                                outlined
                                clearable
                                id="create-room-title"
                                v-model="create_room.room_title"
                            ></v-text-field>
                            <label
                                for="create-room-description"
                                class="text-md-body-1"
                            >
                                Room Description</label
                            >
                            <v-textarea
                                outlined
                                id="create-room-description"
                                v-model="create_room.room_description"
                            ></v-textarea>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="green darken-1"
                            text
                            class="text-uppercase"
                            @click="createRoom"
                        >
                            Create Room
                        </v-btn>
                        <v-btn
                            color="red darken-1"
                            text
                            @click="createRoomDialog = false"
                            class="text-uppercase"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-card
                flat
                class="project-border mt-3"
                v-for="room in rooms"
                :key="room.id"
            >
                <v-card-title class="headline">
                    <h3>{{ room.room_title }}</h3>
                </v-card-title>
                <v-card-text>
                    <div class="pl-5 pb-5">
                        <v-layout>
                            <v-flex md8>
                                <span>{{ room.room_description }}</span>
                            </v-flex>
                            <v-flex md4>
                                <div class="text-right pr-10">
                                    <span>Total of 10 Examinees</span> <br />
                                    <span>Total of 10 Exams</span> <br />
                                    <v-icon
                                        color="black"
                                        size="30"
                                        class="mr-2"
                                    >
                                        mdi-settings-helper
                                    </v-icon>
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
.v-divider {
    border: 1px solid black !important;
}
.project-border {
    border-left: 8px solid #221c92;
}
</style>
<script>
export default {
    data() {
        return {
            userData: {
                id: ""
            },
            create_room: {
                room_title: "",
                room_description: ""
            },
            rooms: [
                {
                    room_title: "English: Purposive Communication",
                    room_description:
                        "Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    room_title: "Mathematics in the Modern World",
                    room_description:
                        "Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    room_title: "Software Engineering",
                    room_description:
                        "Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                }
            ],
            createRoomDialog: false
        };
    },
    mounted() {
        this.getUserData();
    },
    methods: {
        getUserData() {
            axios.get("api/user").then(response => {
                this.userData.id = response.data.user_id;
            });
        },
        createRoom() {
            axios
                .post("/create-room", {
                    examiner_id: this.userData.id,
                    room_title: this.create_room.room_title,
                    room_description: this.create_room.room_description
                })
                .then(response => {
                    console.log("room created");
                })
                .catch(error => {
                    console.log("room creation failed");
                });
        }
    }
};
</script>
