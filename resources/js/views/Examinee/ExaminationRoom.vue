<template>
    <div>
        <h1>Examination Room</h1>
        <v-btn v-on:click="logout">logout</v-btn>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    methods: {
        logout() {
            axios
                .post("/logout")
                .then(response => {
                    this.$router.push({ name: "Index" });
                })
                .catch(err => {
                    console.log("please call an administrator");
                });
        }
    }
};
</script>
