<template>
    <div id="overlay" @click="clickEvent">
        <div id="modal" @click="stopEvent">
            <p><slot></slot></p>
            <p>モーダル</p>
            <p @click="clickEvent">X</p>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        clickEvent() {
            this.$emit('from-child');
        },
        stopEvent() {
            event.stopPropagation();
        },
    },
};
</script>

<style>
#overlay {
    /*要素の順番*/
    z-index: 1;
    /*画面全体を覆う設定*/
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    /*画面中央に配置*/
    display: flex;
    align-items: center;
    justify-content: center;
}
#modal {
    z-index: 2;
    width: 50%;
    padding: 1em;
    background: #fff;
}
</style>
