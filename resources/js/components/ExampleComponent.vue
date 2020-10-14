<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div v-if="userID != ''">
                        <h1>{{userID}}</h1>
                    </div>
                    <div v-else>
                        <h1>Not Logged IN</h1>
                        {{userID}}
                    </div>
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                userID:''
            }
        },
        mounted() {
           this.getCurrentUserData();
        },
        methods:{
            getCurrentUserData(){
                axios.get('api/user').then(response =>{
                    this.userID = response.data.id
                    console.log(response.data)
                }).catch(error => {
                    
                })
            }
        }
    }
</script>
