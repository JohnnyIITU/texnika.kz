<template>
    <div>
        <table class="table table-responsive-sm table-stripper table-data table-bordered">
            <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Эл. почта</th>
                <th>Номер телефона</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in list">
                <td>{{item.id}}</td>
                <td>{{item.email}}</td>
                <td>{{item.phone}}</td>
                <td>{{item.role}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "users-list",
        data() {
            return {
                list: [],
            }
        },
        mounted: function(){
            this.getList()
        },
        methods: {
            getList() {
                this.axios.post('/users/getList', {})
                    .then( response => {
                        this.setList(response.data);
                    })
                    .catch( error => {
                        console.log(error);
                        alert(error);
                    })
            },
            setList(response) {
                response.forEach( item => {
                    this.list.push(item);
                });
            },
        },

    }
</script>

<style>
</style>
