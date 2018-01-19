<template>
    <div class='row'>
        <h1>All Spells</h1>
        <input type="text" v-model="search" placeholder="Spell name.."/>
        <ul class="list-group">
            <li v-if='spellList.length === 0'>There are no spells yet!</li>
            <li class="list-group-item" v-for="spell in filteredList">
                 {{ spell.name }}
            </li>
        </ul>
    </div>
</template>
<script>
class Spell {
    constructor(id, name) {
        this.id = id;
        this.name = name;
    }
}

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
                return spell.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    },

    created() {
        this.fetchTaskList();
    },

    methods: {
        fetchTaskList() {
            axios.get("api/spellList").then(res => {
                console.log(res.data);
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
        }
    }
};
</script>
