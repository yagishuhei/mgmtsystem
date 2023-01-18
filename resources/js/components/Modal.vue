<template>
    <transition name="fade" appear>
        <div id="overlay" @click="clickEvent">
            <div id="modal" @click="stopEvent">
                <p>モーダル</p>

                <transition name="fade">
                    <div class="errorMessage" v-if="show">
                        <ul v-for="error in errors" :key="error.id" class="row">
                            <li>{{ error[0] }}</li>
                        </ul>
                    </div>
                </transition>
                <form v-on:submit.prevent="addFormData(address)">
                    <p>{{ address.id }}</p>
                    <label>address</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="address.address"
                    />
                    <label>ip</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="address.ip"
                    />
                    <label>customer</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="address.customer"
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
                    <button
                        type="submit"
                        @click="errorMessage"
                        class="btn btn-sm btn-success"
                    >
                        Click
                    </button>
                </form>
                <p @click="clickEvent">X</p>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    name: 'Modal',
    props: {
        address: { type: String },
    },

    data: function () {
        return {
            address: [],
            errors: [],
            show: false,
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
                        this.$emit('update-address');
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            } else {
                axios
                    .post('/api/addresses', this.address)
                    .then((res) => {
                        this.$emit('update-address');
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
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
/*表示時*/
.fade-enter {
    opacity: 0;
}
/*表示のアクティブ状態*/
.fade-enter-active {
    transition: all 1s;
}
.fade-leave-active {
    transition: all 1s;
}
/*表示終了時*/
.fade-enter-to {
    opacity: 1;
}
/*非表示時*/
.fade-leave-from {
    opacity: 1;
}
/*非表示の終了時*/
.fade-leave-to {
    opacity: 0;
}
</style>
