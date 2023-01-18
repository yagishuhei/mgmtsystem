<template>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>登録日</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    data: function () {
        return {
            users: [],
        };
    },
    methods: {
        getUsers() {
            axios.get('/api/users').then((res) => {
                this.users = res.data;
            });
        },
    },
    mounted() {
        this.getUsers();
    },
};
</script>
