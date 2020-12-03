<template>
    <div class="template fill-height">
        <v-container class="mt-12" justify="center">
            <div class="text-center">
                <img src="../../assets/img/vixam_logo.png"/>
                <h2 class="mt-3 mb-2 text-lg-h4">Sign in to your account</h2>
                <span class="grey--text text--darken-1">Or</span>
                    <v-dialog
                    v-model="registerDialog"
                    persistent
                    max-width="290"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <span class="indigo--text" v-bind="attrs" v-on="on">create your own account</span>
                    </template>
                    <v-card>
                        <v-card-title class="headline">
                        Use Google's location service?
                        </v-card-title>
                        <v-card-text>Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.</v-card-text>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="green darken-1"
                            text
                            @click="registerDialog = false"
                        >
                            Disagree
                        </v-btn>
                        <v-btn
                            color="green darken-1"
                            text
                            @click="registerDialog = false"
                        >
                            Agree
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
            <v-card class="mt-5 mx-auto" width="500">
                <v-card-text>
                    <div class="ml-8 mr-8 pt-10">
                        <label for="email" class="text-md-body-1"> Email Address</label>
                        <v-text-field solo clearable id="email"></v-text-field>
                        <label for="password" class="text-md-body-1"> Password</label>
                        <v-text-field solo id="password"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            :rules="[rules.required, rules.min]"
                            :type="showPassword ? 'text' : 'password'"
                            name="input-10-2"
                            hint="At least 8 characters"
                            class="input-group--focused"
                            @click:append="showPassword = !showPassword"
                        ></v-text-field>
                        <div class="text-right mr-5">
                        <a href="#"><span class="indigo--text">Forgot your password?</span></a>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <v-btn depressed color="primary" class="signin pr-12 pl-12">Sign in</v-btn>
                    </div>
                    <v-row align="center" class="pr-12 pl-12 mt-5">
                        <v-divider></v-divider> <span class="pr-3 pl-3 text-md-body-1">Or continue with</span> <v-divider></v-divider>
                    </v-row>
                    <div class="mt-5 pr-12 pl-12 mb-4">
                        <v-btn class="ml-3 pr-10 pl-10"><v-icon>mdi-facebook</v-icon></v-btn>
                        <v-btn class="ml-3 mr-3 pr-10 pl-10"><v-icon>mdi-twitter</v-icon></v-btn>
                        <v-btn class="pr-10 pl-10"><v-icon>mdi-github</v-icon></v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap');

h1{
    font-family: 'Roboto', sans-serif;
}
a{
    text-decoration: none;
}

.v-text-field{
    width: 400px;
}

.signin{
    width: 300px;
}

.template{
    background-color: #F5F5F5;
}

</style>

<script>
export default {
    data(){
        return{
            login_data:{
                email:'',
                password:''
            },
            showPassword:false,
            registerDialog:false,
            erroralert:'',
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 8 || 'Min 8 characters',
                emailMatch: () => (`The email and password you entered don't match`),
            },
        }
    },

    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.login_data.email,
                    password: this.login_data.password
                }).then(response => {
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    localStorage.setItem('token',token)
                    this.$router.push({name:'ExampleComponent'})
                }).catch(error => { 
                    this.erroralert = error.response.data
                    console.clear()
                })        
            }).catch(error =>{
                console.log('sanctum error')
            })
        }
    }
}
</script>