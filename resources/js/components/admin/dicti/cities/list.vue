<template>
    <div>
    <div class="flex justify-content-end mb-3">
        <button class="btn btn-success btn-sm"
                @click="addItem()">
            Добавить
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <table class="table table-responsive-sm table-stripper table-data table-bordered">
        <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Операции</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in list">
            <td>{{item.id}}</td>
            <td>{{item.name}}</td>
            <td>
                <!--<button disabled @click="editItem(item.id)" class="btn btn-primary btn-sm">-->
                    <!--Изменить-->
                    <!--<i class="fas fa-pen"></i>-->
                <!--</button>-->
                <button @click="deleteItem(item.id)" class="btn btn-danger btn-sm">
                    Удалить
                    <i class="fas fa-trash"></i>
                </button>

            </td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        name: "cities-list",
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
                this.axios.post('/cities/getList', {})
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
            editItem(id){
                console.log(id);
            },
            deleteItem(id){
                if(confirm('Вы действительно хотите удалить')){
                    this.axios.post('/cities/delete', {id: id})
                        .then(response => {
                            if(response.data.success){
                                alert('Успешно удалено');
                            }else{
                                alert(response.data.error);
                            }
                        });
                }
            },
            addItem(){
                location.href = '/cities/add'
            }
        },

    }
</script>

<style>
</style>
