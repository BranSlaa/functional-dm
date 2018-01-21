<template>
    <modal v-if="show" @close="close">
        <div class="modal-header">
            <h3>New Post</h3>
        </div>
        <div class="modal-body">
            <label class="form-label">
                Title
                <input v-model="title" class="form-control">
            </label>
            <label class="form-label">
                Body
                <textarea v-model="body" rows="5" class="form-control">
                </textarea>
            </label>
        </div>
        <div class="modal-footer text-right">
            <button class="modal-default-button" @click="closeSpell()">
                Save
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    // template: "#new-post-modal-template",
    data() {
        return {
            title: "",
            body: "",
            props: ["show"]
        };
    },
    methods: {
        close: function() {
            console.log("spellModal close called");
            this.$emit("close");
            this.title = "";
            this.body = "";
        },
        closeSpell: function() {
            this.close();
        }
    }
};
</script>
