<template>
    <div class="container">
        <div class="login">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body">
                    <form v-on:submit.prevent="submit(email, password)">
                        <div class="row mb-3">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-end"
                                >メールアドレス</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    v-model="email"
                                />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-end"
                                >パスワード</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    v-model="password"
                                />
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
            users: {},
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
        submit(email, password) {
            axios.get('/sanctum/csrf-cookie').then((res) => {
                axios.post('/api/login', { email, password }).then((res) => {
                    console.log(res);
                });
            });
        },
    },
    mounted() {
        this.getAddresses();
        axios.get('/sanctum/csrf-cookie');
    },
};
</script>
