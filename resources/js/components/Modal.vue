<template>
    <div id="overlay" @click="clickEvent">
        <div id="modal" @click="stopEvent">
            <p>モーダル</p>
            <p>{{ message }}</p>
            <form v-on:submit.prevent="addFormData(address)">
                <p>{{ address.id }}</p>
                <label>address</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.address"
                />
                <label>ip</label>
                <input type="text" class="form-control" v-model="address.ip" />
                <label>customer</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.customer"
                />
                <label>dm_id</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.dm_id"
                />
                <label>place</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.place"
                />
                <label>purpose</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.purpose"
                />
                <label>memo</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.memo"
                />
                <label>staus</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="address.status"
                />
                <button type="submit" class="btn btn-sm btn-success">
                    Click
                </button>
            </form>
            <p @click="clickEvent">X</p>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Modal',
    props: {
        address: 'address',
    },
    data: function () {
        return {
            address: [],
            message: '',
        };
    },
    methods: {
        clickEvent() {
            this.$emit('from-child');
        },
        stopEvent() {
            event.stopPropagation();
        },
        addFormData(address) {
            this.address.id = address.id;
            if (address.id) {
                axios
                    .put('/api/addresses/' + address.id, this.address)
                    .then((res) => {
                        this.message = '成功しました！';
                    });
            } else {
                axios.post('/api/addresses', this.address).then((res) => {
                    this.message = '成功しました！';
                });
            }
            this.$emit('update-address');
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
