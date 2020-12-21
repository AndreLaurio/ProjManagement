<template>
    <div></div>
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        this.getExamDetails();
    },
    methods: {
        getExamDetails() {
            console.log(this.$router.params.id);
        }
    }
};
</script>
