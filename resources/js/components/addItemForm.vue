<template>
    <div class="add">
        <input
            type="text"
            v-model="task.name"
            placeholder="Add a new task"
            @keypress.enter="addItem()"
        />
        <font-awesome-icon
            icon="fa-solid fa-plus"
            @click="addItem()"
            :class="[task.name ? 'active' : 'inactive', 'plus']"
        />
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            task: {
                name: ""
            }
        }
    },
    methods: {
        addItem() {
            if( this.task.name == '' ) {
                return;
            }

            axios.post('api/task/store', {
                task: this.task
            }).then( response => {
                if (response.status == 201) {
                    this.task.name = "";
                    this.$emit('reloadList');
                }
            }).catch( error => {
                console.log(error)
            })
        }
    }
}
</script>
