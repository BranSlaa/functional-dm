<style lang="scss">
* {
    box-sizing: border-box;
}

.filters {
    display: flex;
    justify-content: center;
}

.spellList {
    display: grid;
    grid-gap: 2rem;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    justify-content: center;

    .spellCard {
        text-align: center;
        border: 1px solid #000;
    }

    .highlight {
        color: #bb0000;
        font-weight: bold;
        text-transform: capitalize;
    }
}
</style>
<template>
    <div>
        <div class="filters">
            <h1>All Spells</h1>
            <input type="text" v-model="search" placeholder="Spell name.."/>
        </div>

        <div class="list-group spellList">
            <p v-if='spellList.length === 0'>There are no spells yet!</p>
            <div v-for="spell in filteredList" :key="spell.id">
                 <div class="spellCard" v-on:click="toggleSpellModal(true, spell)">
                     <h2 v-html="highlight(spell.name, search)"></h2>
                     <p v-html="highlight(spell.class, search)"></p>
                     <p v-html="highlight(spell.school, search)"></p>
                     <p>Casting Time: <span>{{ spell.casting_time }}</span></p>
                     <p>Duration: <span>{{ spell.duration }}</span></p>
                 </div>
            </div>
        </div>

        <modal v-show="show" v-on:close="toggleSpellModal(false)">
            <p>{{currentSpell.name}}</p>
            <p>{{currentSpell.class}}</p>
            <p>{{currentSpell.school}}</p>
            <p>{{currentSpell.classification}}</p>
            <p>{{currentSpell.casting_time}}</p>
            <p>{{currentSpell.duration}}</p>
            <p>{{currentSpell.level}}</p>
            <p v-html="currentSpell.desc"></p>
        </modal>
    </div>
</template>
<script>
import Modal from "./Modal.vue";

export default {
    name: "spell-compendium",
    components: {
        modal: Modal
    },
    data() {
        return {
            search: "",
            spellList: [],
            show: false,
            currentSpell: []
        };
    },
    computed: {
        filteredList() {
            return this.spellList.filter(spell => {
                return (
                    spell.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    spell.school
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    spell.class
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
                );
            });
        }
    },

    created() {
        this.fetchTaskList();
    },

    methods: {
        fetchTaskList() {
            axios.get("api/spellList").then(res => {
                this.spellList = res.data;
            });
        },

        createTask() {
            axios
                .post("api/spellList", this.task)
                .then(res => {
                    this.task.name = "";
                    this.edit = false;
                    this.fetchTaskList();
                })
                .catch(err => console.error(err));
        },

        deleteTask(id) {
            axios
                .delete("api/spellList/" + id)
                .then(res => {
                    this.fetchTaskList();
                })
                .catch(err => console.error(err));
        },

        highlight: function(word, search) {
            const pattern = new RegExp(search, "i");
            if (search !== "") {
                return word.replace(
                    pattern,
                    `<span class='highlight'>${search}</span>`
                );
            }
            return word;
        },

        toggleSpellModal(val, spell = []) {
            document.getElementById("body").classList.toggle("modal-open");
            this.show = val;
            this.currentSpell = spell;
        }
    }
};
</script>
