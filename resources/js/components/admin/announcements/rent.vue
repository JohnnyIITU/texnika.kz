<template>
    <div>
        <table class="table table-responsive-sm table-stripper table-data table-bordered">
            <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Тип</th>
                <th>Город</th>
                <th>Цена</th>
                <th>Статус</th>
                <th>Контакты</th>
                <th>Операции</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in list">
                <td>{{item.id}}</td>
                <td>{{item.mark}}</td>
                <td>{{item.model}}</td>
                <td>{{item.type}}</td>
                <td>{{item.city}}</td>
                <td>{{item.price}}</td>
                <td>{{item.status}}</td>
                <td>{{item.phone}}  {{item.email}}</td>
                <td>
                    <button  @click="deleteItem(item.id)" class="btn btn-danger btn-sm">
                        Удалить
                        <i class="fas fa-trash"></i>
                    </button>
                    <button  @click="openItem(item.id)" class="btn btn-primary btn-sm">
                        Открыть объявление
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
        name: "rent-list",
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
                this.axios.post('/rents/getList', {})
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
            deleteItem(id){
                if(confirm('Вы действительно хотите удалить')){
                    this.axios.post('/rents/delete', {id: id})
                        .then(response => {
                            if(response.data.success){
                                alert('Успешно удалено');
                            }else{
                                alert(response.data.error);
                            }
                        });
                }
            },
            openItem(id){
                var link = `https://texnika.kz/rent/view/${id}`;
                window.open(link, '_blank')
            }
        },

    }
</script>

<style>
</style>
