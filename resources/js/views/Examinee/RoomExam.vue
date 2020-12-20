<template>
    <div>
        RoomExam
    </div>
</template>

<script>
export default {
    data() {
        return {
            room_details: []
        };
    },
    mounted() {
        this.getRoomDetail();
        this.getUserDetail();
    },
    methods: {
        getUserDetail() {
            axios.get("api/user").then(response => {});
        },
        getRoomDetail() {
            var room_id = this.$route.params.id;
            axios.get(`api/room-details/${room_id}`).then(response => {
                this.room_details = response.data;
            });
        }
    }
};
</script>
