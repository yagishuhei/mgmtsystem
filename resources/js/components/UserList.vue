<template>
    <div class="card">
        <div class="card-header">
            <!--検索機能-->
            <form @submit.prevent="userSearch">
                <div class="row">
                    <div class="col-md-2">
                        <label class="fs-5 pt-1">キーワード検索</label>
                    </div>
                    <div class="col-md-5">
                        <input
                            type="search"
                            class="form-control"
                            v-model="keyword"
                        />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info">検索</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
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
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            users: [],
            keyword: '',
        };
    },
    methods: {
        getUsers() {
            axios.get('/api/users').then((res) => {
                this.users = res.data;
            });
        },
        userSearch() {
            axios
                .get('/api/users/search', { params: { keyword: this.keyword } })
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getUsers();
    },
};
</script>
