<template>
    <div class="container">

        <h1 id="title-app">TodoList</h1>

        <b-container fluid>
            <!-- list todos -->
            <div id="list-todo">
                <list-todo-list :is_list="isList" :list_todo_list="todoLists" v-on:reloadList="getTodoList" v-on:changeList="changeList"></list-todo-list>
            </div>

            <!-- list tasks -->
            <div id="list-tasks" >
                <list-task v-if="idListToShow" :todo_list_id="idListToShow"></list-task>
                <h3 v-else id="title-none-tasks">Sélectionner une liste</h3>
            </div>

        </b-container>
    </div>
</template>

<script>

import ListTodoList from "./listTodoList";
import ListTask from "./listTask";

export default {
    name: 'app',
    components: {ListTask, ListTodoList},
    data: function () {
        return{
            idListToShow: null,
            todoLists: [],
            isList: false
        }
    },
    methods: {
        getTodoList() {
            axios.get('api/todoLists')
            .then( response => {
                this.idListToShow = null
                this.todoLists = response.data
                if(this.todoLists.length > 0){
                    this.isList = true
                }else{
                    this.isList = false
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        changeList(todo_list_id){
            this.idListToShow = todo_list_id
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
