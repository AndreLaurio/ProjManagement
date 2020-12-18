<template>
    <div class="mt-5 ml-5">
        <h1 class="font-body mb-3">Manage Exam</h1>
        <v-divider class="mr-10"></v-divider>
        <div class="mt-5 mr-10">
            <v-btn class="primary text-uppercase" dark @click="createExam">
                Add New Exam
            </v-btn>
            <v-card
                flat
                class="project-border mt-3 font-body"
                v-for="exam in exams"
                :key="exam.exam_id"
            >
                <v-card-text>
                    <div class="pl-5 pb-5">
                        <v-layout>
                            <v-flex md8>
                                <h2 class="black--text">
                                    {{ exam.exam_title }}
                                </h2>
                                <br />
                                <span>{{ exam.exam_desc }}</span>
                            </v-flex>
                            <v-flex md4>
                                <div class="text-right pr-10 black--text">
                                    <span><b>Total Items: </b> </span> <br />
                                    <span
                                        ><b>Total Points: </b>
                                        {{ exam.exam_total_points }}
                                    </span>
                                    <br />
                                    <span
                                        ><b>Passing Percentage: </b>
                                        {{ exam.passing_percentage }}
                                    </span>
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
                                                        exam.exam_id
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
            items: [{ title: "Edit Exam" }, { title: "Delete" }],
            exams: []
        };
    },
    mounted() {
        this.getExams();
    },
    methods: {
        selectSection(item, room_id) {
            switch (item.title) {
                case "Edit Exam":
                    console.log("Manage Examinees");
                    console.log(room_id);
                    break;
                case "Delete Examoom":
                    console.log("Delete Exam");
                    console.log(room_id);
                    break;
            }
        },
        getExams() {
            axios.get("api/user").then(response => {
                this.user_id = response.data.user_id;

                let instructor_id = this.user_id;
                axios
                    .get(`api/examiner/exams/${instructor_id}`)
                    .then(response => {
                        this.exams = response.data;
                    });
            });
        },
        createExam() {
            this.$router.push({ name: "CreateExam" });
        }
    }
};
</script>
