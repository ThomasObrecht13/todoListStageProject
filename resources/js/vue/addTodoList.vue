<template xmlns="http://www.w3.org/1999/html">
    <div>
        <!-- Add list form -->
        <b-form>
            <b-input-group class="mt-3">
                <b-form-input
                    v-model="todoList.title"
                    type="text"
                    class="mb-2 mr-sm-2 mb-sm-0"
                    placeholder="Indiquer un titre à votre liste"
                    required
                ></b-form-input>
                <b-input-group-append>
                    <b-button @click="addTodoList()" variant="primary">
                        Ajouter une liste
                    </b-button>
                </b-input-group-append>
            </b-input-group>
        </b-form>

    </div>
</template>
<script>



export default {
    data: function () {
        return {
            todoList: {
                title: ''
            }
        }
    },
    methods: {
        addTodoList() {
            if( this.todoList.title ===''){
                return;
            }
            axios.post('api/todoList/store',{
                todoList: this.todoList
            })
            .then( response => {
                if( response.status == 201){
                    this.todoList.title = ''
                    this.$emit('reloadList')
                }
            }).catch( error =>{
                console.log(error)
            })
        }
    }
}
</script>
<style>
#inline-form-input-add{
    margin-left: 10px;
}
</style>
