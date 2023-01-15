<template>
    <div class="container">
        <Modal
            :address="address"
            v-show="showModal"
            v-on:from-child="closeModal"
            v-on:update-address="updatePage"
        ></Modal>
        <div class="card">
            <h1>AddressList</h1>
            <div>
                <button @click="openModal" class="btn btn-primary">追加</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">住所</th>
                        <th scope="col">イプ</th>
                        <th scope="col">ドム</th>
                        <th scope="col">顧客</th>
                        <th scope="col">保管所</th>
                        <th scope="col">目的</th>
                        <th scope="col">メモ</th>
                        <th scope="col">ステータス</th>
                        <th scope="col">登録日</th>
                        <th scope="col">更新日</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(address, index) in addresses" :key="index">
                        <th scope="col">{{ address.id }}</th>
                        <td>{{ address.address }}</td>
                        <td>{{ address.ip }}</td>
                        <td>{{ address.dm_id }}</td>
                        <td>{{ address.customer }}</td>
                        <td>{{ address.place }}</td>
                        <td>{{ address.purpose }}</td>
                        <td>{{ address.memo }}</td>
                        <td>{{ address.status }}</td>
                        <td>{{ address.created_at }}</td>
                        <td>{{ address.updated_at }}</td>
                        <!--引数を渡す-->
                        <td>
                            <button
                                class="btn btn-success"
                                @click="openModal(address, showModal)"
                            >
                                Edit
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import Modal from './Modal.vue';
export default {
    components: {
        Modal,
    },
    data: function () {
        return {
            addresses: [],
            //modal
            showModal: false,
            address: '',
        };
    },
    methods: {
        getAddresses() {
            axios.get('/api/addresses').then((res) => {
                this.addresses = res.data;
            });
        },
        //ModalMethods
        openModal(address) {
            this.address = address;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        updatePage() {
            this.getAddresses();
            this.showModal = false;
        },
    },
    mounted() {
        this.getAddresses();
    },
};
</script>
<style>
/*表示時*/
.fade-enter-from {
    opacity: 0;
}
/*表示のアクティブ状態*/
.fade-enter-active {
    transition: all 0.5s;
}
/*表示終了時*/
.fade-enter-to {
    opacity: 1;
}
/*非表示時*/
.fade-leave-from {
    opacity: 1;
}
/*非表示のアクティブ状態*/
.fade-leave-active {
    transition: all 0.5s;
}
/*非表示の終了時*/
.fade-leave-to {
    opacity: 0;
}
</style>
