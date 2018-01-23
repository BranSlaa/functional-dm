require("./bootstrap");

window.Vue = require("vue");

const app = new Vue({
    el: "#app",
    components: {
        Home: require("./components/Home.vue"),
        SpellCompendium: require("./components/SpellCompendium.vue"),
        MonsterCreator: require("./components/MonsterCreator.vue")
    }
});
