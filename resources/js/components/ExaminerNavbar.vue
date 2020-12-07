<template>
    <nav>
        <v-navigation-drawer v-model="drawer" app color="grey lighten-5">
            <v-list dense>
                <v-list-item-group
                    v-model="group"
                    active-class="deep-purple--text text--accent-4"
                >
                    <v-list-item link>
                        <v-list-item-action>
                            <v-icon color="#760D11">mdi-face</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            Profile
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link>
                        <v-list-item-action>
                            <v-icon color="#760D11"
                                >mdi-clipboard-text-multiple</v-icon
                            >
                        </v-list-item-action>
                        <v-list-item-content>
                            Manage Rooms
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link>
                        <v-list-item-action>
                            <v-icon color="#760D11"
                                >mdi-clipboard-text-multiple</v-icon
                            >
                        </v-list-item-action>
                        <v-list-item-content>
                            Manage Exam
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link v-on:click="logout">
                        <v-list-item-action>
                            <v-icon color="#760D11">mdi-logout</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            Logout
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="#760D11" dark>
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>Vixam</v-toolbar-title>
        </v-app-bar>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            drawer: true,
            group: null
        };
    },
    mounted() {
        this.userDetails();
    },
    methods: {
        userDetails() {
            axios.get("api/user").then(response => {
                console.log(response.data);
            });
        },
        logout() {
            axios
                .post("/logout")
                .then(response => {
                    this.$router.push({ name: "Index" });
                    localStorage.clear();
                })
                .catch(err => {
                    console.log("please call an administrator");
                });
        }
    }
};
</script>
