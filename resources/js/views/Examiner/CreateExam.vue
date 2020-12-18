<template>
    <div class="mt-5 ml-5 font-body">
        <h1 class="font-body mb-3">Create Exam</h1>
        <v-divider class="mr-10"></v-divider>
        <div class="mt-5">
            <v-layout>
                <v-flex md2>
                    <v-navigation-drawer permanent color="#B0B0CE" height="750">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title class="title mt-2">
                                    <h3
                                        class="white--text font-body"
                                        @click="showExamDetailInput"
                                    >
                                        Exam Details
                                    </h3>
                                    <v-divider
                                        class="ml-3 mr-3 mt-3 mb-5"
                                    ></v-divider>
                                    <h3
                                        class="white--text font-body"
                                        @click="showExamItemInput"
                                    >
                                        Exam Items
                                    </h3>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <template v-slot:append>
                            <div class="pa-2 text-center mb-5">
                                <v-btn class="pl-12 pr-12" depressed rounded
                                    >save</v-btn
                                >
                            </div>
                        </template>
                    </v-navigation-drawer>
                </v-flex>
                <v-flex md10>
                    <div v-if="examDetailInput">
                        <h2>Exam Details</h2>
                        <v-layout class="mt-5">
                            <v-flex md2>
                                <h2 class="grey--text">Exam title :</h2>
                                <h2 class="grey--text mt-8">
                                    Exam description :
                                </h2>
                            </v-flex>
                            <v-flex md10>
                                <v-text-field
                                    clearable
                                    outlined
                                    rounded
                                    dense
                                    class="title-input"
                                ></v-text-field>
                                <v-textarea outlined rounded> </v-textarea>
                            </v-flex>
                        </v-layout>
                        <v-divider class="mr-7"></v-divider>
                        <h2 class="mt-5">Exam Scoring</h2>
                        <v-layout>
                            <v-flex md3>
                                <h2 class="grey--text mt-1">
                                    Passing Percentage (%) :
                                </h2>
                            </v-flex>
                            <v-flex md9>
                                <v-text-field
                                    type="number"
                                    outlined
                                    dense
                                    class="percentage-input"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-divider class="mr-7"></v-divider>
                        <h2 class="mt-5">Exam Configuraiton</h2>
                        <v-layout>
                            <v-flex md3 class="mt-2">
                                <h2 class="grey--text mt-1">
                                    Shuffle Question :
                                </h2>
                                <h2 class="grey--text mt-1">
                                    Examinee Reviewing their Answer :
                                </h2>
                                <h2 class="grey--text mt-1">
                                    Monitor Switching Tab :
                                </h2>
                            </v-flex>
                            <v-flex md9>
                                <v-checkbox> </v-checkbox>
                                <v-checkbox> </v-checkbox>
                                <v-checkbox> </v-checkbox>
                            </v-flex>
                        </v-layout>
                    </div>
                    <div v-if="examItemInput">
                        <v-btn outlined rounded @click="showAddNewSection">
                            Add New Section</v-btn
                        >
                        <v-btn outlined rounded @click="showAddNewQuestion">
                            Add New Question</v-btn
                        >
                        <v-divider class="mr-7 mt-5 mb-3"></v-divider>
                        <div v-if="addNewSection">
                            <h3>Exam Section</h3>
                            <v-layout>
                                <v-flex md2 class="mt-5">
                                    <h3>Title :</h3>
                                    <h3>Description :</h3>
                                </v-flex>
                                <v-flex md10>
                                    <v-text-field
                                        clearable
                                        outlined
                                        rounded
                                        dense
                                        class="title-input mt-3"
                                    ></v-text-field>
                                    <v-textarea outlined rounded> </v-textarea>
                                </v-flex>
                            </v-layout>
                            <v-divider class="mr-7 mt-5 mb-3"></v-divider>
                            <v-layout>
                                <v-flex>
                                    <h3>Position</h3>
                                </v-flex>
                                <v-flex>
                                    <v-select
                                        :items="positions"
                                        label="Positions"
                                    ></v-select>
                                </v-flex>
                            </v-layout>
                            <v-divider class="mr-7 mt-5 mb-3"></v-divider>
                            <v-btn>Remove Section</v-btn>
                        </div>
                        <div v-if="addNewQuestion">
                            <h3>Exam Question</h3>
                            <v-layout>
                                <v-flex md2 class="mt-5">
                                    <h3>Question Type :</h3>
                                    <h3>Question :</h3>
                                    <h3 v-if="this.selectQuestionType == 1">
                                        Number of Elements :
                                    </h3>
                                </v-flex>
                                <v-flex>
                                    <v-select
                                        v-model="selectedQuestionType"
                                        item-text="name"
                                        item-value="id"
                                        :items="questionTypes"
                                    ></v-select>
                                    <v-textarea outlined></v-textarea>
                                    <v-text-field
                                        v-if="this.selectQuestionType == 1"
                                        type="number"
                                        outlined
                                        dense
                                        class="percentage-input"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-divider class="mr-7 mt-5 mb-3"></v-divider>

                            <div v-if="this.selectedQuestionType == 1">
                                <h1>Enumeration Elements</h1>
                                <v-btn>Add New Element</v-btn>
                                <v-card>
                                    <v-card-text>
                                        <table>
                                            <tr>
                                                <th>#</th>
                                                <th>Label</th>
                                                <th>Remove</th>
                                            </tr>
                                            <tr>
                                                <td>A</td>
                                                <td>
                                                    <v-card>
                                                        <v-card-text>
                                                            <v-textarea
                                                                outlined
                                                            >
                                                            </v-textarea>
                                                        </v-card-text>
                                                    </v-card>
                                                </td>
                                                <td>
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                    <v-layout>
                                        <v-flex>
                                            Case Sensitive ?
                                        </v-flex>
                                        <v-flex>
                                            <v-checkbox> </v-checkbox>
                                        </v-flex>
                                    </v-layout>
                                    <v-layout>
                                        <v-flex>
                                            Answer must in order?
                                        </v-flex>
                                        <v-flex>
                                            <v-checkbox></v-checkbox>
                                        </v-flex>
                                    </v-layout>
                                </v-card>
                                <v-divider class="ml-5 mr-5"></v-divider>
                                <h1>Scoring</h1>
                                <v-layout>
                                    <v-flex>
                                        Points :
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex>
                                        Points per Elements:
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout>
                                    <v-flex>
                                        <h3>Position</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            :items="positions"
                                            label="Positions"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn>Remove Question</v-btn>
                            </div>
                            <div v-if="this.selectedQuestionType == 2">
                                <h1>Scoring</h1>
                                <v-layout>
                                    <v-flex>
                                        Points :
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout>
                                    <v-flex>
                                        <h3>Position</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            :items="positions"
                                            label="Positions"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn>Remove Question</v-btn>
                            </div>
                            <div v-if="this.selectedQuestionType == 3">
                                <h1>Answer</h1>
                                <v-layout>
                                    <v-flex>
                                        <h3>Correct Answer</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            label="True or False"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <h1>Scoring</h1>
                                <v-layout>
                                    <v-flex>
                                        <h3>Points</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout>
                                    <v-flex>
                                        <h3>Position</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            :items="positions"
                                            label="Positions"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn>Remove Question</v-btn>
                            </div>
                            <div v-if="this.selectedQuestionType == 4">
                                <h1>Choices</h1>
                                <v-btn>Add New Choice</v-btn>
                                <v-card>
                                    <v-card-text>
                                        <table>
                                            <tr>
                                                <th>#</th>
                                                <th>Label</th>
                                                <th>is Correct?</th>
                                                <th>Remove</th>
                                            </tr>
                                            <tr>
                                                <td>A</td>
                                                <td>
                                                    <v-card>
                                                        <v-card-text>
                                                            <v-textarea
                                                                outlined
                                                            >
                                                            </v-textarea>
                                                        </v-card-text>
                                                    </v-card>
                                                </td>
                                                <td>
                                                    <v-checkbox></v-checkbox>
                                                </td>
                                                <td>
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                </v-card>
                                <v-layout>
                                    <v-flex>
                                        Suffle Choices
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <h3>Scoring</h3>
                                <v-layout>
                                    <v-flex>
                                        Points
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout>
                                    <v-flex>
                                        <h3>Position</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            :items="positions"
                                            label="Positions"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn>Remove Question</v-btn>
                            </div>
                            <div v-if="this.selectedQuestionType == 5">
                                <h1>Choices</h1>
                                <v-btn>Add New Choice</v-btn>
                                <v-card>
                                    <v-card-text>
                                        <table>
                                            <tr>
                                                <th>#</th>
                                                <th>Label</th>
                                                <th>is Correct?</th>
                                                <th>Remove</th>
                                            </tr>
                                            <tr>
                                                <td>A</td>
                                                <td>
                                                    <v-card>
                                                        <v-card-text>
                                                            <v-textarea
                                                                outlined
                                                            >
                                                            </v-textarea>
                                                        </v-card-text>
                                                    </v-card>
                                                </td>
                                                <td>
                                                    <v-checkbox></v-checkbox>
                                                </td>
                                                <td>
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                </v-card>
                                <v-layout>
                                    <v-flex>
                                        Suffle Choices
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex>
                                        Examinee must select:
                                    </v-flex>
                                    <v-flex>
                                        <v-select></v-select>
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <h3>Scoring</h3>
                                <v-layout>
                                    <v-flex>
                                        Points
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex>
                                        Points Per Choice ?
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout>
                                    <v-flex>
                                        <h3>Position</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                            :items="positions"
                                            label="Positions"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn>Remove Question</v-btn>
                            </div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
.font-body {
    font-family: "Poppins", sans-serif;
}
.title-input {
    width: 500px;
}
.percentage-input {
    width: 80px;
}
</style>

<script>
export default {
    data() {
        return {
            examDetailInput: true,
            examItemInput: false,
            addNewSection: true,
            addNewQuestion: false,
            selectedQuestionType: 1,
            positions: [
                "At the beginning of section 1",
                "After Section 1",
                "Fizz",
                "Buzz"
            ],
            questionTypes: [
                { id: 1, name: "Enumeration" },
                { id: 2, name: "Free-Text" },
                { id: 3, name: "True or False" },
                { id: 4, name: "Single-select Multiple Choice" },
                { id: 5, name: "Multi-select Multiple Choice" }
            ]
        };
    },
    methods: {
        showExamDetailInput() {
            this.examDetailInput = true;
            this.examItemInput = false;
        },
        showExamItemInput() {
            this.examItemInput = true;
            this.examDetailInput = false;
        },
        showAddNewQuestion() {
            this.addNewQuestion = true;
            this.addNewSection = false;
        },
        showAddNewSection() {
            this.addNewSection = true;
            this.addNewQuestion = false;
        },
        getQuestionType() {
            console.log(this.questionTypes.value);
        }
    }
};
</script>
