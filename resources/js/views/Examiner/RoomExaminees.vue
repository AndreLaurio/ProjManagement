<template> </template>
<script>
export default {
    data() {
        return {};
    },
    mounted() {
        this.getRoomId();
    },
    methods: {
        getRoomId() {
            console.log(this.$route.params.id);
        }
    }
};
</script>
