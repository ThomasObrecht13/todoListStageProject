<template>
    <div>

        <h3>Vos tâches</h3>
        <!-- add task component  -->
        <add-task id="add-task":todo_list_id="todo_list_id" v-on:reloadTasks="getTasks(todo_list_id)"></add-task>

        <!-- list tasks -->
        <b-container>
            <div v-for="(task, id) in tasks" :key="id">
                <item-task id="test" :task="task" v-on:reloadTasks="getTasks(todo_list_id)" ></item-task>
            </div>
        </b-container>

    </div>
</template>
<script>

import ItemTask from "./itemTask";
import AddTask from "./addTask";

export default {
    name: 'list-task',
    components: {AddTask, ItemTask},
    props: ['todo_list_id'],
    data: function () {
        return{
            tasks: []
        }
    },
    watch: {
        todo_list_id: function() {
            this.getTasks(this.todo_list_id)
        }
    },
    methods: {
        getTasks(todo_list_id) {
            axios.get('api/tasks/'+todo_list_id)
                .then( response => {
                    this.tasks = response.data
                })
                .catch(error =>{
                    console.log(error);
                })
        },
        deleteTask(idTask){
            axios.delete('api/task/'+idTask)
                .then( response => {
                    if( response.status == 200){
                        this.getTasks(this.todo_list_id)
                    }
                })
                .catch( error => {
                    console.log(error);
                })
        },
    },
    created() {
        this.getTasks(this.todo_list_id)
    }

}
</script>

<style>
#add-task{
    margin-bottom: 30px;
}
#test{
    margin-top: 25px;
}
</style>
