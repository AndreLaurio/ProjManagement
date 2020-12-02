<template>
    <v-app>
        <div>
            <input  class="bg-blue-500" type="text" v-model="login_data.email">
            <input type="text" v-model="login_data.password">
            <button v-on:click="login">Login</button>
            <v-btn class="primary">test</v-btn>
            <h1>{{erroralert}}</h1>
        </div>
    </v-app>
</template>

<script>
export default {
    data(){
        return{
            login_data:{
                email:'',
                password:''
            },
            erroralert:'',
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