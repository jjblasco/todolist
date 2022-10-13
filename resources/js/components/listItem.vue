<template>
    <div>
        <span class="itemText">{{ task.name }}</span>
        <button @click="updateItem()" :class="['status', task.statusTask]">
            {{ task.statusTask }}
        </button>
        <button @click="removeItem()" class="deleteItem">
            <font-awesome-icon icon="fa-solid fa-trash" />
        </button>
    </div>
</template>

<script>
export default {
    props: ['task'],
    methods: {
        updateItem() {
            axios.put('/api/task/' + this.task.id, {
                task: this.task
            }).then( response => {
                if( response.status == 200) {
                    this.$emit('itemChanged');
                }
            }).catch( error => {
                console.log(error)
            })
        },
        removeItem() {
            axios.delete('/api/task/' + this.task.id, {
                task: this.task
            }).then( response => {
                if( response.status == 200) {
                    this.$emit('itemChanged');
                }
            }).catch( error => {
                console.log(error)
            })
        }
    }
}
</script>
