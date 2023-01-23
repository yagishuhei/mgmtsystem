<template>
    <div class="card">
        <table class="table table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">氏名</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">登録日</th>
                    <th scope="col">更新日</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>{{ user.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
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
