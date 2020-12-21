<template>
    <div class="template fill-height font-body">
        <v-container class="mt-12" justify="center">
            <div class="text-center">
                <img src="../../assets/img/vixam_logo.png" />
                <h1 class="mt-3 mb-2 for-title">Sign in to your account</h1>
                <span class="grey--text text--darken-1">Or</span>
                <v-dialog v-model="registerDialog" persistent max-width="550">
                    <template v-slot:activator="{ on, attrs }">
                        <span class="indigo--text" v-bind="attrs" v-on="on"
                            >create your own account</span
                        >
                    </template>
                    <v-card class="register-card font-body">
                        <v-card-title class="pl-8 pr-8 pt-8 justify-center">
                            <span
                                class="text-center text-uppercase register-title"
                                >Register Form</span
                            >
                        </v-card-title>
                        <v-card-text>
                            <div class="ml-8 mr-8">
                                <v-row>
                                    <v-col>
                                        <label
                                            for="first-name"
                                            class="text-md-body-1 register-input"
                                        >
                                            First Name</label
                                        >
                                        <v-text-field
                                            outlined
                                            clearable
                                            id="first-name"
                                            v-model="register_data.first_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <label
                                            for="last-name"
                                            class="text-md-body-1 register-input"
                                        >
                                            Last Name</label
                                        >
                                        <v-text-field
                                            outlined
                                            clearable
                                            id="last-name"
                                            v-model="register_data.last_name"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </div>
                            <!-- <div class="ml-8 mr-8">
                                <label for="last-name" class="text-md-body-1"> Last Name</label>
                                <v-text-field solo clearable id="last-name"></v-text-field>
                            </div> -->
                            <div class="ml-8 mr-8">
                                <label
                                    for="register-email"
                                    class="text-md-body-1"
                                >
                                    Email Address</label
                                >
                                <v-text-field
                                    outlined
                                    prepend-inner-icon="mdi-email-outline"
                                    clearable
                                    id="register-email"
                                    v-model="register_data.email"
                                ></v-text-field>
                            </div>
                            <div class="ml-8 mr-8">
                                <!-- <label for="register-password" class="text-md-body-1 register-input"> Password</label>
                                <v-text-field solo clearable prepend-inner-icon="mdi-key-variant" id="register-password"></v-text-field>
                                <label for="register-confirm-password" class="text-md-body-1 register-input"> Confirm Password</label>
                                <v-text-field solo clearable prepend-inner-icon="mdi-key-variant" id="register-confirm-password"></v-text-field> -->
                                <v-row>
                                    <v-col>
                                        <label
                                            for="register-password"
                                            class="text-md-body-1 register-input"
                                        >
                                            Password</label
                                        >
                                        <v-text-field
                                            outlined
                                            clearable
                                            prepend-inner-icon="mdi-key-variant"
                                            id="register-password"
                                            v-model="register_data.password"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <label
                                            for="register-confirm-password"
                                            class="text-md-body-1 register-input"
                                        >
                                            Confirm Password</label
                                        >
                                        <v-text-field
                                            outlined
                                            clearable
                                            prepend-inner-icon="mdi-key-variant"
                                            id="register-confirm-password"
                                            v-model="
                                                register_data.confirm_password
                                            "
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </div>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                dark
                                outlined
                                @click="register"
                                class="primary text-uppercase rounded-lg"
                            >
                                Register
                            </v-btn>
                            <v-btn
                                color="indigo"
                                outlined
                                @click="registerDialog = false"
                                class="text-uppercase rounded-lg"
                            >
                                Close
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
            <v-card class="mt-5 mx-auto" width="500">
                <v-card-text>
                    <div class="ml-8 mr-8 pt-10">
                        <label for="email" class="text-md-body-1">
                            Email Address</label
                        >
                        <v-text-field
                            solo
                            prepend-inner-icon="mdi-email-outline"
                            clearable
                            id="email"
                            v-model="login_data.email"
                            class="input-login"
                        ></v-text-field>
                        <label for="password" class="text-md-body-1">
                            Password</label
                        >
                        <v-text-field
                            solo
                            id="password"
                            :append-icon="
                                showPassword ? 'mdi-eye' : 'mdi-eye-off'
                            "
                            :rules="[rules.required, rules.min]"
                            :type="showPassword ? 'text' : 'password'"
                            name="input-10-2"
                            hint="At least 8 characters"
                            class="input-group--focused input-login"
                            @click:append="showPassword = !showPassword"
                            prepend-inner-icon="mdi-key-variant"
                            v-model="login_data.password"
                        ></v-text-field>
                        <div class="text-right mr-5">
                            <v-dialog
                                v-model="forgotPwDialog"
                                persistent
                                max-width="550"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <span
                                        class="indigo--text"
                                        v-bind="attrs"
                                        v-on="on"
                                        >Forgot your password?</span
                                    >
                                </template>
                                <v-card class="register-card font-body">
                                    <v-card-title
                                        class="pl-8 pr-8 pt-8 justify-center"
                                    >
                                        <span
                                            class="text-center text-uppercase text-lg-h6 indigo--text"
                                            >Reset Password</span
                                        >
                                    </v-card-title>
                                    <v-card-text>
                                        <div class="ml-8 mr-8">
                                            <label
                                                for="register-email"
                                                class="text-md-body-1"
                                            >
                                                Email Address</label
                                            >
                                            <v-text-field
                                                outlined
                                                prepend-inner-icon="mdi-email-outline"
                                                clearable
                                                id="register-email"
                                                v-model="forgotPw_data.email"
                                            ></v-text-field>
                                        </div>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            dark
                                            @click="forgotPassword"
                                            class="primary text-uppercase rounded-lg"
                                        >
                                            Send Email
                                        </v-btn>
                                        <v-btn
                                            outlined
                                            color="indigo"
                                            @click="forgotPwDialog = false"
                                            class="text-uppercase rounded-lg"
                                        >
                                            Close
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <div>
                            <ul>
                                <li
                                    v-for="valErr in validationError"
                                    :key="valErr.id"
                                    class="red--text"
                                >
                                    {{ valErr }}
                                </li>
                            </ul>
                        </div>
                        <v-btn
                            depressed
                            color="primary"
                            class="signin pr-12 pl-12"
                            v-on:click="login"
                            :loading="loginLoading"
                            >Sign in</v-btn
                        >
                    </div>
                    <v-row align="center" class="pr-12 pl-12 mt-5">
                        <v-divider></v-divider>
                        <span class="pr-3 pl-3 text-md-body-1"
                            >Or continue with</span
                        >
                        <v-divider></v-divider>
                    </v-row>
                    <div class="mt-5 pr-12 pl-12 mb-4">
                        <v-btn class="ml-3 pr-10 pl-10"
                            ><v-icon>mdi-facebook</v-icon></v-btn
                        >
                        <v-btn class="ml-3 mr-3 pr-10 pl-10"
                            ><v-icon>mdi-twitter</v-icon></v-btn
                        >
                        <v-btn class="pr-10 pl-10"
                            ><v-icon>mdi-github</v-icon></v-btn
                        >
                    </div>
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;800&display=swap");

.font-body {
    font-family: "Poppins", sans-serif;
}

.font-title {
    font-family: "Padauk", sans-serif;
}

a {
    text-decoration: none;
}

.input-login {
    width: 400px;
}

.input-register {
    width: 350px;
}

.signin {
    width: 300px;
}

.template {
    background-color: #f5f5f5;
}

.register-title {
    font-family: "Open Sans", sans-serif;
    font-size: 2rem;
    font-weight: 800;
    color: #4f46e5;
}

ul {
    list-style-type: none;
}
</style>

<script>
//vanila js

//start of vue
export default {
    data() {
        return {
            login_data: {
                email: "",
                password: ""
            },
            register_data: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                confirm_password: ""
            },
            forgotPw_data: {
                email: ""
            },
            loginLoading: false,
            showPassword: false,
            registerDialog: false,
            forgotPwDialog: false,
            validationError: [],
            rules: {
                required: value => !!value || "Required.",
                min: v => v.length >= 8 || "Min 8 characters",
                emailMatch: () =>
                    `The email and password you entered don't match`
            }
        };
    },
    mounted() {
        this.changetab();
    },
    methods: {
        login() {
            this.loginLoading = true;
            axios
                .get("/sanctum/csrf-cookie")
                .then(response => {
                    axios
                        .post("/login", {
                            email: this.login_data.email,
                            password: this.login_data.password
                        })
                        .then(response => {
                            var token = document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content");
                            localStorage.setItem("token", token);

                            axios.get("api/user").then(response => {
                                var userType = response.data.user_type_id;
                                if (userType == 1) {
                                    this.$router.push({
                                        name: "ExaminationRoom"
                                    });
                                } else if (userType == 2) {
                                    this.$router.push({
                                        name: "ManageRoom"
                                    });
                                }
                            });
                        })
                        .catch(error => {
                            let validationErrors = Object.values(
                                error.response.data.errors
                            );
                            validationErrors = validationErrors.flat();
                            this.validationError = validationErrors;
                            this.loginLoading = false;
                        });
                })
                .catch(error => {
                    console.log("sanctum error");
                    this.loginLoading = false;
                });
        },
        register() {
            axios
                .post("/register", {
                    first_name: this.register_data.first_name,
                    last_name: this.register_data.last_name,
                    email: this.register_data.email,
                    password: this.register_data.password,
                    password_confirmation: this.register_data.confirm_password,
                    user_type_id: 1
                })
                .then(response => {
                    console.log("registered successfully");
                })
                .catch(error => {
                    console.log("registered failed");
                });
        },
        forgotPassword() {
            axios
                .post("/password/email", {
                    email: this.forgotPw_data.email
                })
                .then(response => {
                    console.log("sent successfully");
                })
                .catch(error => {
                    console.log("sending failed");
                });
        },
        changetab() {
            document.addEventListener("visibilitychange", function() {
                if (document.hidden) {
                    console.log("nagpalitngtab");
                }
            });
        }
    }
};
</script>
