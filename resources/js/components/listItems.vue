<template>
    <div class="items">
        <list-item
            v-for="(task, index) in tasks" :key="index"
            :task="task"
            class="item"
            v-on:itemChanged="$emit('reloadList')"
        />

    </div>
</template>

<script>
import listItem from "./listItem.vue"

export default {
    props: ['tasks'],
    components: {
        listItem
    }
}
</script>

