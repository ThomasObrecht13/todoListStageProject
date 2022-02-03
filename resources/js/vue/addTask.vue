<template>
    <b-container>
        <!-- Add task form -->
        <b-form>
            <b-input-group class="mt-3">
                <b-form-input
                    v-model="task.title"
                    type="text"
                    class="mb-2 mr-sm-2 mb-sm-0"
                    placeholder="Quel est vôtre tâche ?"
                    required
                ></b-form-input>
                <b-input-group-append>
                    <b-button @click="addTask()" variant="primary">
                        Ajouter une tâche
                    </b-button>
                </b-input-group-append>
            </b-input-group>
        </b-form>

    </b-container>
</template>
<script>



export default {
    props:[
        'todo_list_id'
    ],
    data: function () {
        return {
            task: {
                title: '',
                todo_list_id: this.todo_list_id
            }
        }
    },
    methods: {
        addTask() {
            if( this.task.title ===''){
                return;
            }
            this.task.todo_list_id = this.todo_list_id
            axios.post('api/task/store',{
                task: this.task
            })
                .then( response => {
                    if( response.status == 201){
                        this.task.title = ''
                        this.$emit('reloadTasks')
                    }
                }).catch( error =>{
                console.log(error)
            })
        }
    }
}
</script>
