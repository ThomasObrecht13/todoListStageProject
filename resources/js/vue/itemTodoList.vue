<template>
    <div>

        <!-- todos data  -->
        <b-row>
            <b-col cols="8">
                <h5><b-link href="#" @click="changeList(todo_list.id)">{{ todo_list.title }}</b-link></h5>
            </b-col>

            <!-- delete todos button -->
            <b-col cols="4">
                <b-button size="sm" @click="showDeleteConfirmationModal" class="mb-2 bg-danger">
                    <b-icon icon="trash" aria-hidden="true"></b-icon>Effacer
                </b-button>
            </b-col>
        </b-row>

        <!-- popup -->
        <b-modal ref="delete-confirmation-modal" hide-header>
            Si vous supprimez cette liste toutes les tâches associées seront supprimées
            <template #modal-footer="{ ok, cancel}">
                <b-button size="sm" variant="success" @click="deleteTodoList(todo_list.id)">
                    OK
                </b-button>
                <b-button size="sm" variant="danger" @click="hideDeleteConfirmationModal">
                    Annuler
                </b-button>
            </template>
        </b-modal>

    </div>

</template>
<script>


export default {
    props: ['todo_list'],
    methods: {
        deleteTodoList(todoListId) {
            axios.delete('api/todoList/'+todoListId)
                .then( response => {
                    if( response.status == 200){
                        this.$emit('reloadList');
                        this.hideDeleteConfirmationModal()
                    }
                })
                .catch( error => {
                    console.log(error);
                })
        },
        showDeleteConfirmationModal() {
            this.$refs['delete-confirmation-modal'].show()
        },
        hideDeleteConfirmationModal() {
            this.$refs['delete-confirmation-modal'].hide()
        },
        changeList(todo_list_id) {
            this.$emit('changeList',todo_list_id)
        }
    }
}
</script>
