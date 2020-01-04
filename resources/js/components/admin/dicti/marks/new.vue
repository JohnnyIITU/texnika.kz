<template>
    <div>
        <form action="">
            <div class="form-group offset-md-2 offset-ld-2 offset-0 col-md-8 col-lg-8 col-12">
                <label for="fullname">Наименование</label>
                <input class="form-control" type="text" v-model="fullname" id="fullname">
            </div>
            <div class="flex justify-content-center form-group">
                <button class="btn btn-info btn-lg mt-2" type="button" @click="create">Применить</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "marks-new",
        data() {
            return {
                fullname: "",
            }
        },
        methods: {
            create() {
                if(this.fullname === ""){
                    alert('Заполните поле');
                }

                this.axios.post('/marks/add', {name: this.fullname})
                    .then(response => {
                        if(response.data.success){
                            alert('Успешно добавлено');
                            location.href = '/'
                        }else{
                            alert(response.error)
                        }
                    })

            }
        },
    }
</script>

<style>
</style>
