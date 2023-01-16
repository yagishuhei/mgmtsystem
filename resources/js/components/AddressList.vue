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
                                @click="openModal(address)"
                            >
                                Edit
                            </button>
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                v-on:click="deleteAddress(address)"
                            >
                                Delete
                            </button>
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
        deleteAddress(address) {
            axios.delete('/api/addresses/' + address.id).then((res) => {
                this.getAddresses();
            });
        },
        //ModalMethods
        openModal(address) {
            this.showModal = true;
            this.address = address;
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
