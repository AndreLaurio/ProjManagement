import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Index",
        component: () => import("./views/Index")
    },
    {
        path: "/examination-room",
        name: "ExaminationRoom",
        component: () => import("./views/Examinee/ExaminationRoom"),
        meta: { requiresAuth: true }
    },
    {
        path: "/room-exam/:id",
        name: "RoomExam",
        component: () => import("./views/Examinee/RoomExam"),
        meta: { requiresAuth: true }
    },
    {
        path: "/manage-room",
        name: "ManageRoom",
        component: () => import("./views/Examiner/ManageRoom"),
        meta: { requiresAuth: true }
    },
    {
        path: "/manage-exam",
        name: "ManageExam",
        component: () => import("./views/Examiner/ManageExam"),
        meta: { requiresAuth: true }
    },
    {
        path: "/create-exam",
        name: "CreateExam",
        component: () => import("./views/Examiner/CreateExam"),
        meta: { requiresAuth: true }
    },
    {
        path: "*",
        name: "404",
        component: () => import("./views/404")
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
