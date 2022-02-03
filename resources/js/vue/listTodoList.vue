<template>
    <b-container>
        <h3>Vos listes</h3>
        <!-- add list component  -->
        <add-todo-list id="add-todo-list" v-on:reloadList="reloadList"></add-todo-list>

        <!-- list todos -->
        <div v-if="is_list">
            <div v-for="(todo_list, id) in list_todo_list" :key="id">
                <item-todo-list :todo_list="todo_list" v-on:changeList="changeList" v-on:reloadList="reloadList"></item-todo-list>
            </div>
        </div>

        <div v-else>Vous n'avez aucune liste</div>

    </b-container>
</template>
<script>


import AddTodoList from "./addTodoList";
import ItemTodoList from "./itemTodoList";
export default {
    name: 'list-todo-list',
    props: ['list_todo_list','is_list'],
    components: {AddTodoList,ItemTodoList},
    methods: {
        changeList(todo_list_id) {
            this.$emit('changeList',todo_list_id);
        },
        reloadList(){
            this.$emit('reloadList');
        }
    }
}
</script>

<style>
#add-todo-list{
    margin-bottom: 10px;
}
</style>
