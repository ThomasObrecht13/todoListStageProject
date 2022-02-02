<template>
    <div>
        <b-row id="list-tasks">

            <!-- Task data and checkbox for completed task -->
            <b-col cols="8">
                <div>
                    <b-form-checkbox
                        :checked="[task.completed ? 'true': 'false','false']"
                        @change="taskCompleted(task.id)">

                        <span id="title" :class="[task.completed ? 'completed': '']">
                            {{task.title}}
                        </span>
                    </b-form-checkbox>
                </div>
            </b-col>

            <!-- Options buttons -->
            <b-col cols="4">
                <b-button-group>
                    <b-button size="sm" @click="deleteTask(task.id)" class="mb-2 bg-danger">
                        <b-icon icon="trash" aria-hidden="true"></b-icon> Effacer
                    </b-button>
                    <b-button size="sm" @click="showEditModal" class="mb-2 bg-info">
                        <b-icon icon="pen" aria-hidden="true"></b-icon> Modifier
                    </b-button>
                </b-button-group>
            </b-col>
        </b-row>
        <hr>

        <!-- Popup -->
        <b-modal ref="edit-modal" hide-footer>
            <!-- header -->
            <template #modal-header="{ close }">
                <h5>Modifier votre tâche</h5>
                <b-button size="sm" variant="outline-danger" @click="hideEditModal()">
                    X
                </b-button>
            </template>

            <!-- update form -->
            <b-input-group class="mt-3">
                <b-form-input
                    id="inline-form-input-username"
                    type="text"
                    class="mb-2 mr-sm-2 mb-sm-0 w-50"
                    size="sm"
                    v-model="title"
                    placeholder="Indiquer un titre à votre liste"
                    required
                ></b-form-input>
                <b-input-group-append>
                    <b-button @click="updateTask(task.id)" variant="primary">
                        Modifier la tâche
                    </b-button>
                </b-input-group-append>
            </b-input-group>

        </b-modal>
    </div>
</template>
<script>

export default {
    name: 'item-task',
    props: ['task'],
    data: function () {
        return{
            title: this.task.title
        }
    },
    methods: {
        deleteTask(idTask) {
            axios.delete('api/task/' + idTask)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('reloadTasks')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        showEditModal() {
            this.$refs['edit-modal'].show()
        },
        hideEditModal() {
            this.title = this.task.title
            this.$refs['edit-modal'].hide()
        },
        taskCompleted(idTask) {
            axios.put('api/task/' + idTask)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('reloadTasks');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateTask(idTask) {
            this.task.title = this.title
            axios.put('api/task/update/' + idTask, {
                task: this.task
            })
                .then(response => {
                    if (response.status == 200) {
                        this.hideEditModal()
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },
    created() {
            this.title = this.task.title
    }
}
</script>
<style>
.completed{
    text-decoration: line-through;
    color: #a0aec0;
}
#title{
    padding-left: 5px;
}
</style>
