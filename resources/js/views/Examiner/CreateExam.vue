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
                                <div class="mini-buttons">
                                    <v-btn dense>1</v-btn>
                                </div>
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
                                <span class="text-lg-h6">Exam Title :</span>
                            </v-flex>
                            <v-flex md10>
                                <v-text-field
                                    clearable
                                    outlined
                                    rounded
                                    dense
                                    class="title-input"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout>
                            <v-flex md2>
                                <span class="mt-12 text-lg-h6">
                                    Exam Description :
                                </span>
                            </v-flex>
                            <v-flex md10>
                                <v-textarea outlined rounded class="mr-12">
                                </v-textarea>
                            </v-flex>
                        </v-layout>
                        <v-divider class="mr-7"></v-divider>
                        <h2 class="mt-5">Exam Scoring</h2>
                        <v-layout>
                            <v-flex md3>
                                <span class="text-lg-h6 mt-1">
                                    Passing Percentage (%) :
                                </span>
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
                            <v-flex md4 class="mt-5">
                                <span class="text-lg-h6">
                                    Shuffle Question :
                                </span>
                            </v-flex>
                            <v-flex md8 class="mt-1">
                                <v-checkbox> </v-checkbox>
                            </v-flex>
                        </v-layout>
                        <v-layout>
                            <v-flex md4 class="mt-5">
                                <span class="text-lg-h6 mt-1">
                                    Examinee Reviewing their Answer :
                                </span>
                            </v-flex>
                            <v-flex md8 class="mt-2">
                                <v-checkbox> </v-checkbox>
                            </v-flex>
                        </v-layout>
                        <v-layout>
                            <v-flex md4 class="mt-4">
                                <span class="text-lg-h6">
                                    Monitor Switching Tab :
                                </span>
                            </v-flex>
                            <v-flex md8 class="mt-1">
                                <v-checkbox> </v-checkbox>
                            </v-flex>
                        </v-layout>
                    </div>
                    <div v-if="examItemInput">
                        <v-btn
                            outlined
                            rounded
                            color="indigo"
                            @click="showAddNewSection"
                        >
                            Add New Section</v-btn
                        >
                        <v-btn
                            outlined
                            rounded
                            color="indigo"
                            class="ml-5"
                            @click="showAddNewQuestion"
                        >
                            Add New Question</v-btn
                        >
                        <v-divider class="mr-7 mt-5 mb-3"></v-divider>
                        <div v-if="addNewSection">
                            <h2>Exam Section</h2>
                            <v-layout class="mt-5">
                                <v-flex md2>
                                    <span class="text-lg-h6">Title :</span>
                                </v-flex>
                                <v-flex md10>
                                    <v-text-field
                                        clearable
                                        outlined
                                        rounded
                                        dense
                                        class="title-input"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout>
                                <v-flex md2>
                                    <span class="mt-12 text-lg-h6">
                                        Description :
                                    </span>
                                </v-flex>
                                <v-flex md10>
                                    <v-textarea outlined rounded class="mr-12">
                                    </v-textarea>
                                </v-flex>
                            </v-layout>
                            <v-divider class="mr-7 mt-5 mb-5"></v-divider>
                            <v-layout>
                                <v-flex md2>
                                    <h2>Position</h2>
                                </v-flex>
                                <v-flex md10>
                                    <v-select
                                        dense
                                        outlined
                                        rounded
                                        :items="positions"
                                        label="Positions"
                                        class="position-select"
                                    ></v-select>
                                </v-flex>
                            </v-layout>
                            <v-divider class="mr-7 mb-3"></v-divider>
                            <v-btn outlined rounded class="mt-5" color="indigo"
                                >Remove Section</v-btn
                            >
                        </div>
                        <div v-if="addNewQuestion">
                            <h2>Exam Question</h2>
                            <v-layout class="mt-5">
                                <v-flex md2>
                                    <span class="text-lg-h6"
                                        >Question Type :</span
                                    >
                                </v-flex>
                                <v-flex md10>
                                    <v-select
                                        v-model="selectedQuestionType"
                                        rounded
                                        dense
                                        outlined
                                        class="question-type-select"
                                        item-text="name"
                                        item-value="id"
                                        :items="questionTypes"
                                    ></v-select>
                                </v-flex>
                            </v-layout>
                            <v-layout>
                                <v-flex md2>
                                    <span class="mt-12 text-lg-h6">
                                        Question :
                                    </span>
                                </v-flex>
                                <v-flex md10>
                                    <v-textarea outlined rounded class="mr-12">
                                    </v-textarea>
                                </v-flex>
                            </v-layout>
                            <div v-if="this.selectedQuestionType == 1">
                                <v-layout>
                                    <v-flex md2>
                                        <span class="mt-12 text-lg-h6">
                                            Number of Elements :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </div>
                            <v-divider class="mr-7 mt-5 mb-3"></v-divider>
                            <div v-if="this.selectedQuestionType == 1">
                                <h2>Enumeration Elements</h2>
                                <v-btn
                                    dense
                                    rounded
                                    outlined
                                    color="indigo"
                                    class="mt-5"
                                    >Add New Element</v-btn
                                >
                                <v-card
                                    class="ml-12 mr-12 mt-5 rounded-xl"
                                    width="1000"
                                >
                                    <v-card-text>
                                        <table border="1" class="table-choices">
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th class="ml-5">Label</th>
                                                <th class="ml-5">Remove</th>
                                            </tr>
                                            <tr>
                                                <td class="ml-5">A</td>
                                                <td class="ml-5">
                                                    <div class="text-center">
                                                        <v-textarea
                                                            class="label-choices"
                                                            outlined
                                                        >
                                                        </v-textarea>
                                                    </div>
                                                </td>
                                                <td class="ml-5">
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                </v-card>
                                <v-layout class="mt-5">
                                    <v-flex md2 class="mt-5">
                                        Case Sensitive ?
                                    </v-flex>
                                    <v-flex md10>
                                        <v-checkbox> </v-checkbox>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex md2 class="mt-5">
                                        Answer must in order?
                                    </v-flex>
                                    <v-flex md10>
                                        <v-checkbox></v-checkbox>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <h2>Scoring</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points per Elements:
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mb-2"></v-divider>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <h2>Position</h2>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <v-btn
                                    outlined
                                    rounded
                                    class="mt-5 mb-5"
                                    color="indigo"
                                    >Remove Question</v-btn
                                >
                            </div>
                            <div v-if="this.selectedQuestionType == 2">
                                <h2>Scoring</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <h2>Position</h2>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn
                                    outlined
                                    rounded
                                    class="mt-5"
                                    color="indigo"
                                    >Remove Question</v-btn
                                >
                            </div>
                            <div v-if="this.selectedQuestionType == 3">
                                <h2>Answer</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Correct Answer
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            rounded
                                            outlined
                                            dense
                                            class="position-select"
                                            label="True or False"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <h2>Scoring</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <h2>Position</h2>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn
                                    outlined
                                    rounded
                                    class="mt-5 mb-5"
                                    color="indigo"
                                    >Remove Question</v-btn
                                >
                            </div>
                            <div v-if="this.selectedQuestionType == 4">
                                <h2>Choices</h2>
                                <v-btn
                                    dense
                                    rounded
                                    outlined
                                    color="indigo"
                                    class="mt-5"
                                    >Add New Choice</v-btn
                                >
                                <v-card
                                    class="ml-12 mr-12 mt-5 rounded-xl"
                                    width="1000"
                                >
                                    <v-card-text>
                                        <table border="1" class="table-choices">
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th class="ml-5">Label</th>
                                                <th class="ml-5">
                                                    is Correct?
                                                </th>
                                                <th class="ml-5">Remove</th>
                                            </tr>
                                            <tr>
                                                <td class="ml-5">A</td>
                                                <td class="ml-5">
                                                    <div class="text-center">
                                                        <v-textarea
                                                            class="label-choices"
                                                            outlined
                                                        >
                                                        </v-textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <v-checkbox></v-checkbox>
                                                </td>
                                                <td class="ml-5">
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                </v-card>
                                <v-layout class="mt-5">
                                    <v-flex md2 class="mt-5">
                                        <span class="text-lg-h6">
                                            Suffle Choices
                                        </span>
                                    </v-flex>
                                    <v-flex md10 class="mt-1">
                                        <v-checkbox></v-checkbox>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mb-2"></v-divider>
                                <h2>Scoring</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <h2>Position</h2>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn
                                    outlined
                                    rounded
                                    class="mt-5 mb-5"
                                    color="indigo"
                                    >Remove Question</v-btn
                                >
                            </div>
                            <div v-if="this.selectedQuestionType == 5">
                                <h2>Choices</h2>
                                <v-btn
                                    dense
                                    rounded
                                    outlined
                                    color="indigo"
                                    class="mt-5"
                                    >Add New Choice</v-btn
                                >
                                <v-card
                                    class="ml-12 mr-12 mt-5 rounded-xl"
                                    width="1000"
                                >
                                    <v-card-text>
                                        <table border="1" class="table-choices">
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th class="ml-5">Label</th>
                                                <th class="ml-5">
                                                    is Correct?
                                                </th>
                                                <th class="ml-5">Remove</th>
                                            </tr>
                                            <tr>
                                                <td class="ml-5">A</td>
                                                <td class="ml-5">
                                                    <div class="text-center">
                                                        <v-textarea
                                                            class="label-choices"
                                                            outlined
                                                        >
                                                        </v-textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <v-checkbox></v-checkbox>
                                                </td>
                                                <td class="ml-5">
                                                    X
                                                </td>
                                            </tr>
                                        </table>
                                    </v-card-text>
                                </v-card>
                                <v-layout class="mt-5">
                                    <v-flex md2 class="mt-5">
                                        <span class="text-lg-h6">
                                            Suffle Choices
                                        </span>
                                    </v-flex>
                                    <v-flex md10 class="mt-1">
                                        <v-checkbox></v-checkbox>
                                    </v-flex>
                                </v-layout>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Examinee must select:
                                        </span>
                                    </v-flex>
                                    <v-flex md9>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                        <!-- <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field> -->
                                    </v-flex>
                                    <!-- <v-flex md1> -->
                                    <!-- <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex> -->
                                </v-layout>
                                <v-divider class="mb-2"></v-divider>
                                <h2>Scoring</h2>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points :
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex md2>
                                        <span class="text-lg-h6">
                                            Points per Choices:
                                        </span>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-text-field
                                            type="number"
                                            outlined
                                            dense
                                            class="percentage-input"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="mr-7 mb-2"></v-divider>
                                <v-layout class="mt-5">
                                    <v-flex md2>
                                        <h2>Position</h2>
                                    </v-flex>
                                    <v-flex md10>
                                        <v-select
                                            dense
                                            outlined
                                            rounded
                                            :items="positions"
                                            label="Positions"
                                            class="position-select"
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                                <v-divider></v-divider>
                                <v-btn
                                    outlined
                                    rounded
                                    class="mt-5 mb-5"
                                    color="indigo"
                                    >Remove Question</v-btn
                                >
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

.position-select {
    width: 300px;
}

.question-type-select {
    width: 400px;
}

.table-choices {
    width: 80%;
}
.table-choices td {
    text-align: center;
}
.table-choices th {
    text-align: center;
    vertical-align: middle;
}
.label-choices {
    width: 300px;
}

.mini-buttons v-btn {
    width: 30px;
    min-width: 30px;
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
