<template>
    <v-container>
        <div>
            <v-layout>
                <v-flex>
                    <v-card width="800" class="rounded-lg question-card">
                        <v-card-text class="pl-12 pr-12">
                            <p class="text-md-body-1 black--text">
                                <span class="black--text text-lg-h6">1.</span>
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in
                                reprehenderit in voluptate velit esse cillum
                                dolore eu fugiat nulla pariatur.
                            </p>
                            <v-divider class="mt-5 mb-5"></v-divider>
                            <div class="black--text text-md-body-1 ml-12 mr-12">
                                <v-layout>
                                    <v-flex>
                                        <v-radio value="Duckduckgo">
                                            <template v-slot:label>
                                                <div class="black--text">
                                                    A.
                                                    <strong
                                                        class="primary--text"
                                                        >Duckduckgo</strong
                                                    >
                                                </div>
                                            </template>
                                        </v-radio>
                                    </v-flex>
                                    <v-flex>
                                        <v-radio value="Duckduckgo">
                                            <template v-slot:label>
                                                <div class="black--text">
                                                    B.
                                                    <strong
                                                        class="primary--text"
                                                        >Duckduckgo</strong
                                                    >
                                                </div>
                                            </template>
                                        </v-radio>
                                    </v-flex>
                                </v-layout>
                                <v-layout>
                                    <v-flex>
                                        <v-radio value="Duckduckgo">
                                            <template v-slot:label>
                                                <div class="black--text">
                                                    C.
                                                    <strong
                                                        class="primary--text"
                                                        >Duckduckgo</strong
                                                    >
                                                </div>
                                            </template>
                                        </v-radio>
                                    </v-flex>
                                    <v-flex>
                                        <v-radio value="Duckduckgo">
                                            <template v-slot:label>
                                                <div class="black--text">
                                                    D.
                                                    <strong
                                                        class="primary--text"
                                                        >Duckduckgo</strong
                                                    >
                                                </div>
                                            </template>
                                        </v-radio>
                                    </v-flex>
                                </v-layout>
                            </div>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn outlined color="indigo" class="rounded-lg">
                                Previous</v-btn
                            >
                            <v-spacer></v-spacer>
                            <v-btn
                                outlined
                                color="indigo"
                                class="rounded-lg pl-5 pr-5"
                                >Next</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-flex>
                <v-flex>
                    <v-navigation-drawer permanent color="#B0B0CE" height="750">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title class="title mt-2">
                                    <h3 class="white--text font-body">
                                        Exam Details
                                    </h3>
                                    <v-divider
                                        class="ml-3 mr-3 mt-3 mb-5"
                                    ></v-divider>
                                    <h3 class="white--text font-body">
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
                                    >Submit</v-btn
                                >
                            </div>
                        </template>
                    </v-navigation-drawer>
                </v-flex>
            </v-layout>
        </div>
    </v-container>
</template>

<style scoped>
.question-card {
    border: 1px black solid;
}
</style>

<script>
export default {};
</script>
