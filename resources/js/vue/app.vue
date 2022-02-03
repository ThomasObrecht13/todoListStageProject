<template>
    <b-container>

        <h1 id="title-app">TodoList</h1>

        <b-container fluid>
            <!-- list todos -->
            <div id="list-todo">
                <list-todo-list :is_list="is_list" :list_todo_list="todo_lists" v-on:reloadList="getTodoList" v-on:changeList="changeList"></list-todo-list>
            </div>

            <!-- list tasks -->
            <div id="list-tasks" >
                <list-task v-if="id_list_to_show" :todo_list_id="id_list_to_show"></list-task>
                <h3 v-else id="title-none-tasks">Sélectionner une liste</h3>
            </div>

        </b-container>
    </b-container>
</template>

<script>

import ListTodoList from "./listTodoList";
import ListTask from "./listTask";

export default {
    name: 'app',
    components: {ListTask, ListTodoList},
    data: function () {
        return{
            id_list_to_show: null,
            todo_lists: [],
            is_list: false
        }
    },
    methods: {
        getTodoList() {
            axios.get('api/todoLists')
            .then( response => {
                this.id_list_to_show = null
                this.todo_lists = response.data
                if(this.todo_lists.length > 0){
                    this.is_list = true
                }else{
                    this.is_list = false
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        changeList(todo_list_id){
            this.id_list_to_show = todo_list_id
        }
    },
    created() {
        this.getTodoList();
    }
}
</script>

<style>
#list-tasks{
    margin-top: 10px;
}
</style>
