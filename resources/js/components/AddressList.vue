<template>
    <div class="container">
        <div class="card">
            <h1>住所リスト</h1>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            addresses: [],
        };
    },
    methods: {
        getAddress() {
            axios.get('/api/addresses').then((res) => {
                this.addresses = res.data;
            });
        },
    },
    mounted() {
        this.getAddress();
    },
};
</script>
