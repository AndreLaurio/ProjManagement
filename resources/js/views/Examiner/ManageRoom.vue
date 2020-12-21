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
                <v-card class="font-body rounded-lg">
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
                        <div class="mb-2">
                            <v-btn
                                outlined
                                dark
                                class="primary text-uppercase rounded-lg"
                                @click="createRoom"
                            >
                                Create Room
                            </v-btn>
                            <v-btn
                                outlined
                                color="indigo"
                                @click="createRoomDialog = false"
                                class="text-uppercase rounded-lg"
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
                                    <span
                                        >Total of
                                        {{ room.total_examinees }}
                                        Examinees</span
                                    >
                                    <br />
                                    <span
                                        >Total of
                                        {{ room.total_exams }} Exams</span
                                    >
                                    <br />
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
                <v-card class="font-body rounded-lg">
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
                        <div class="mb-2">
                            <v-btn
                                dark
                                outlined
                                class="primary text-uppercase"
                                @click="updateRoom"
                            >
                                Update Room
                            </v-btn>
                            <v-btn
                                color="indigo"
                                outlined
                                @click="manageRoomDetails = false"
                                class="text-uppercase"
                            >
                                Close
                            </v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="manageRoomExams" persistent max-width="600">
                <v-card class="font-body rounded-lg">
                    <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                        <span class="text-center text-uppercase register-title"
                            >Add Existing Exam</span
                        >
                    </v-card-title>
                    <v-card-text>
                        <label for="select-exam" class="text-lg-h6 black--text"
                            >Choose an exam</label
                        >
                        <v-select
                            dense
                            outlined
                            rounded
                            :items="exams"
                            id="select-exam"
                            class="exam-select"
                        ></v-select>
                        <v-divider class="mb-5"></v-divider>
                        <span class="text-lg-h6 black--text"
                            >Configure Exam Settings</span
                        >
                        <div class="mt-5">
                            <v-layout>
                                <v-flex class="mt-3">
                                    <span class="text-lg-h6">Open at:</span>
                                </v-flex>
                                <v-flex>
                                    <v-menu
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-text-field
                                                v-model="date"
                                                label="Select Date"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="date"
                                            @input="menu2 = false"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-flex>
                                <v-flex>
                                    <v-menu
                                        ref="menu"
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="time"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-text-field
                                                v-model="time"
                                                label="Select Time"
                                                prepend-icon="mdi-clock-time-four-outline"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="menu2"
                                            v-model="time"
                                            full-width
                                            @click:minute="
                                                $refs.menu.save(time)
                                            "
                                        ></v-time-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>
                        </div>
                        <div class="mt-5">
                            <v-layout>
                                <v-flex class="mt-3">
                                    <span class="text-lg-h6">Close at:</span>
                                </v-flex>
                                <v-flex>
                                    <v-menu
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-text-field
                                                v-model="date"
                                                label="Select Date"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="date"
                                            @input="menu2 = false"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-flex>
                                <v-flex>
                                    <v-menu
                                        ref="menu"
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="time"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template
                                            v-slot:activator="{ on, attrs }"
                                        >
                                            <v-text-field
                                                v-model="time"
                                                label="Select Time"
                                                prepend-icon="mdi-clock-time-four-outline"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            v-if="menu2"
                                            v-model="time"
                                            full-width
                                            @click:minute="
                                                $refs.menu.save(time)
                                            "
                                        ></v-time-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>
                        </div>
                        <div>
                            <v-layout>
                                <v-flex md5>
                                    <span class="text-lg-h6"
                                        >Time limit (in minutes)</span
                                    >
                                </v-flex>
                                <v-flex md7>
                                    <v-text-field
                                        type="number"
                                        outlined
                                        dense
                                        class="limit-input"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <div class="mb-2">
                            <v-btn
                                outlined
                                dark
                                @click="manageRoomExams = false"
                                class="primary text-uppercase rounded-lg"
                            >
                                Add
                            </v-btn>
                            <v-btn
                                outlined
                                color="indigo"
                                @click="manageRoomExams = false"
                                class="text-uppercase rounded-lg"
                            >
                                Close
                            </v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="deleteRoomConfirmation"
                persistent
                max-width="550"
            >
                <v-card class="font-body rounded-lg">
                    <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                        Are you sure to delete?
                    </v-card-title>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <div class="mb-2">
                            <v-btn
                                outlined
                                dark
                                @click="deleteRoom"
                                class="primary text-uppercase rounded-lg"
                            >
                                Delete
                            </v-btn>
                            <v-btn
                                color="indigo"
                                outlined
                                @click="deleteRoomConfirmation = false"
                                class="text-uppercase rounded-lg"
                            >
                                Close
                            </v-btn>
                        </div>
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

.exam-select {
    width: 500px;
}

.limit-input {
    width: 80px;
}
</style>
<script>
export default {
    data() {
        return {
            rooms: [],
            exams: [],
            menu2: false,
            date: new Date().toISOString().substr(0, 10),
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
            selected_room: {
                room_id: "",
                room_title: "",
                room_desc: "",
                room_index: ""
            },
            user_id: "",
            createRoomDialog: false,
            manageRoomDetails: false,
            manageRoomExams: false,
            deleteRoomConfirmation: false
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
                    this.createRoomDialog = false;
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
                    this.manageRoomExams = true;
                    this.selected_room.room_id = room_id;
                    this.getExams(room_id);
                    break;
                case "Manage Examinees":
                    this.$router.push({
                        name: "ManageExaminees",
                        params: {
                            id: room_id
                        }
                    });
                    break;
                case "Delete Room":
                    this.deleteRoomConfirmation = true;
                    this.selected_room.room_id = room_id;
                    this.selected_room.room_index = room_index;
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
        deleteRoom() {
            var room_id = this.selected_room.room_id;
            var room_index = this.selected_room.room_index;
            axios
                .delete(`api/delete-room/${room_id}`)
                .then(response => {
                    this.rooms.splice(room_index, 1);
                    this.deleteRoomConfirmation = false;
                })
                .catch(error => {
                    console.log("error not deleted");
                });
        },
        getExams(room_id) {
            axios
                .get(`api/exams/${room_id}`)
                .then(response => {
                    this.exams = response.data;
                })
                .catch(error => {
                    console.log("error");
                });
        }
    }
};
</script>
