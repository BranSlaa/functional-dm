<style>
.spellList:nth-child(odd) {
    background-color: #ddd;
}
.highlight {
    color: #bb0000;
    font-weight: bolder;
}
</style>
<template>
    <div class='row'>
        <h1>All Spells</h1>
        <input type="text" v-model="search" placeholder="Spell name.."/>
        <ul class="list-group">
            <li v-if='spellList.length === 0'>There are no spells yet!</li>
            <li class="list-group-item spellList" v-for="spell in filteredList">
                 <span v-html="highlight(spell.name, search)"></span> - <span v-html="highlight(spell.school, search)"></span> - <span v-html="highlight(spell.class, search)"></span> - <span v-html="highlight(spell.desc, search)"></span>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data() {
        return {
            search: "",
            spellList: []
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
                    `<span class='highlight'>${search.toUpperCase()}</span>`
                );
            }
            return word;
        }
    }
};
</script>
