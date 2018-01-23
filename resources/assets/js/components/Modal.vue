<style <style lang="scss">
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
}

.modal-enter,
.modal-leave-active {
    opacity: 0;

    .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
}
</style>
<template>
    <transition name="modal">
        <div class="modal-mask" @click="close">
            <div class="modal-container">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    name: "modal",
    template: "#modal-template",
    methods: {
        close: function() {
            this.$emit("close");
        }
    },
    mounted: function() {
        document.addEventListener("keydown", e => {
            if (e.keyCode == 27) {
                this.$emit("close");
            }
        });
    }
};
</script>
