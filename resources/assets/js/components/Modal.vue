<template>
    <transition name="modal">
        <div class="modal-mask" @click="close" v-show="show">
            <div class="modal-container" @click.stop>
                <slot></slot>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    template: "#modal-template",
    data() {
        return {
            show: false
        };
    },
    methods: {
        close: function() {
            console.log("modal close called");
            this.$emit("close");
        }
    },
    mounted: function() {
        document.addEventListener("keydown", e => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }
};
</script>
