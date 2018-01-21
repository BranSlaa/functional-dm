<style lang="scss">
body.modal-open {
    overflow: hidden;
}

* {
    box-sizing: border-box;
}

.modal-mask {
    position: fixed;
    z-index: 5;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
}

.modal-container {
    width: 80vw;
    height: 80vh;
    overflow-y: auto;
    margin: 40px auto 0;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.text-right {
    text-align: right;
}

.form-label {
    display: block;
    margin-bottom: 1em;
}

.form-label > .form-control {
    margin-top: 0.5em;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.5em 1em;
    line-height: 1.5;
    border: 1px solid #ddd;
}

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.filters {
    display: flex;
    justify-content: center;
}

.spellList {
    display: grid;
    grid-gap: 2rem;
    // grid-template-columns: repeat(5, 15%);
    // grid-template-rows: 100px 100px 100px;
    // grid-auto-flow: row;
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
    <div id="spellCompendium">
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

        <transition name="modal">
        <div class="modal-mask" @click="toggleSpellModal(false)" v-show="show">
            <div class="modal-container" @click.stop>
                <slot></slot>
                <p>{{currentSpell.name}}</p><br/>
                <p>{{currentSpell.class}}</p><br/>
                <p>{{currentSpell.school}}</p><br/>
                <p>{{currentSpell.classification}}</p><br/>
                <p>{{currentSpell.casting_time}}</p><br/>
                <p>{{currentSpell.duration}}</p><br/>
                <p>{{currentSpell.level}}</p><br/>
                <p v-html="currentSpell.desc"></p>
            </div>
        </div>
    </transition>
    </div>
</template>
<script>
export default {
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
