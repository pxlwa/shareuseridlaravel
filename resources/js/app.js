import "./bootstrap";
import Vue from "vue";
import ShareId from "./components/ShareId.vue";

Vue.component("share-id", ShareId);

const app = new Vue({
    el: "#app",
});
