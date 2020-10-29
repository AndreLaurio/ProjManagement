<template>
    <v-app>
        <div>
            <input type="text" v-model="login_data.email">
            <input type="text" v-model="login_data.password">
            <button v-on:click="login">Login</button>
            <v-btn class="primary">test</v-btn>
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
            }
        }
    },

    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.login_data.email,
                    password: this.login_data.password
                }).then(response => {
                    this.$router.push({name:'ExampleComponent'})
                }).catch(error => {
                    console.log(error.response.data)
                })        
            }).catch(error =>{
                console.log('sanctum error')
            })
        }
    }
}
</script>