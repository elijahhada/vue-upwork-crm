<template>
    <div class="p-4 rounded shadow-lg">
        <h2>{{ title }}</h2>
        <p>{{ excerpt }}</p>

        <div class="flex space-x-4">
            <button @click="showModal" class="px-6 py-4 bg-white shadow-lg rounded">Забрать</button>
        </div>
    </div>
</template>

<script>
import AddDeal from "../Modals/AddDeal";

export default {
    components: {
    },
    props: {
        title: {
            required: true,
            type: String,
        },
        excerpt: {
            required: true,
            type: String,
        }
    },
    methods: {
        showModal() {
            console.log(this.$modal.show(
                AddDeal
            ))
        }
    },
    mounted() {
        console.log(this);
    }
}
</script>

<style scoped>

</style>
