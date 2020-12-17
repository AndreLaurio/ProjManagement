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
                class="project-border mt-3 font-body"
                v-for="(room, room_index) in rooms"
                :key="room.id"
            >
                <v-card-text>
                    <div class="pl-5 pb-5">
                        <v-layout>
                            <v-flex md8>
                                <h2 class="black--text">
                                    {{ room.room_title }}
                                </h2>
                                <br />
                                <span>{{ room.room_desc }}</span>
                            </v-flex>
                            <v-flex md4>
                                <div class="text-right pr-10 black--text">
                                    <span class="black--text font-weight-bold"
                                        >Room Code :</span
                                    >
                                    <span>{{ room.room_code }}</span>
                                    <br />
                                    <span>Total of 10 Examinees</span> <br />
                                    <span>Total of 10 Exams</span> <br />
                                    <v-menu offset-y>
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-icon
                                                color="black"
                                                size="30"
                                                class="mr-2"
                                                v-on="on"
                                                v-bind="attrs"
                                            >
                                                mdi-settings-helper
                                            </v-icon>
                                        </template>
                                        <v-list>
                                            <v-list-item
                                                v-for="(item, index) in items"
                                                :key="index"
                                                @click="
                                                    selectSection(
                                                        item,
                                                        room.room_id,
                                                        room.room_desc,
                                                        room.room_title,
                                                        room_index
                                                    )
                                                "
                                            >
                                                <v-list-item-title
                                                    class="font-body"
                                                    >{{
                                                        item.title
                                                    }}</v-list-item-title
                                                >
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
                                </div>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-card-text>
            </v-card>
            <v-dialog v-model="manageRoomDetails" persistent max-width="550">
                <v-card class="font-body">
                    <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                        <span class="text-center text-uppercase register-title"
                            >Manage Room</span
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
                                v-model="update_room.room_title"
                            ></v-text-field>
                            <label
                                for="create-room-description"
                                class="text-md-body-1"
                            >
                                Room Description</label
                            >
                            <v-textarea
                                outlined
                                v-model="update_room.room_description"
                            ></v-textarea>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="green darken-1"
                            text
                            class="text-uppercase"
                            @click="updateRoom"
                        >
                            Update Room
                        </v-btn>
                        <v-btn
                            color="red darken-1"
                            text
                            @click="manageRoomDetails = false"
                            class="text-uppercase"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
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
            user_id: "",
            items: [
                { title: "Manage Room Details" },
                { title: "Manage Room Exams" },
                { title: "Manage Examinees" },
                { title: "Delete Room" }
            ],
            create_room: {
                room_title: "",
                room_description: ""
            },
            update_room: {
                room_title: "",
                room_description: ""
            },
            rooms: [],
            createRoomDialog: false,
            manageRoomDetails: false,
            selected_room: {
                room_id: "",
                room_title: "",
                room_desc: ""
            }
        };
    },
    mounted() {
        this.getRooms();
    },
    methods: {
        createRoom() {
            //random code generator
            var result = "";
            var length = 6;
            var characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(
                    Math.floor(Math.random() * charactersLength)
                );
            }
            axios
                .post("api/create-room", {
                    examiner_id: this.user_id,
                    room_code: result,
                    room_title: this.create_room.room_title,
                    room_description: this.create_room.room_description
                })
                .then(response => {
                    this.rooms.push({
                        room_title: this.create_room.room_title,
                        room_desc: this.create_room.room_description,
                        room_code: result
                    });
                })
                .catch(error => {
                    console.log("room creation failed");
                });
        },
        selectSection(item, room_id, room_desc, room_title, room_index) {
            switch (item.title) {
                case "Manage Room Details":
                    console.log("Manage Room Details");
                    this.manageRoomDetails = true;
                    this.selected_room.room_id = room_id;
                    this.update_room.room_title = room_title;
                    this.update_room.room_description = room_desc;
                    break;
                case "Manage Room Exams":
                    console.log("Manage Room Exams");
                    console.log(room_id);
                    break;
                case "Manage Examinees":
                    console.log("Manage Examinees");
                    console.log(room_id);
                    break;
                case "Delete Room":
                    this.deleteRoom(room_id, room_index);
                    break;
            }
        },
        getRooms() {
            axios.get("api/user").then(response => {
                this.user_id = response.data.user_id;

                let instructor_id = this.user_id;
                axios.get(`api/rooms/${instructor_id}`).then(response => {
                    this.rooms = response.data;
                });
            });
        },
        updateRoom() {
            var room_id = this.selected_room.room_id;
            axios
                .put(`api/update-room/${room_id}`, {
                    room_title: this.update_room.room_title,
                    room_description: this.update_room.room_description
                })
                .then(response => {
                    console.log("updated successfuly");
                })
                .catch(error => {
                    console.log("update failed");
                });
        },
        deleteRoom(room_id, room_index) {
            axios
                .delete(`api/delete-room/${room_id}`)
                .then(response => {
                    this.rooms.splice(room_index, 1);
                })
                .catch(error => {
                    console.log("error not deleted");
                });
        }
    }
};
</script>
