<template>
    <main>
        <div class="head">
            <h1 id="title">To do list</h1>
            <add-item-form
                v-on:reloadList="getList()"
            />
        </div>
        <list-items
            :tasks="tasks"
            v-on:reloadList="getList()"
        />
    </main>

</template>

<script>
import addItemForm from "./addItemForm.vue";
import listItems from "./listItems.vue";
export default {
    components:{
        addItemForm,
        listItems
    },
    data: function() {
        return {
            tasks: []
        }
    },
    methods: {
        getList() {
            axios.get('api/tasks')
            .then(response => {
                this.tasks = response.data
                console.log(this.tasks)
            }).catch(error => {
                console.log(error)
            })
        }
    },
    created() {
        this.getList();
    }
}
</script>


