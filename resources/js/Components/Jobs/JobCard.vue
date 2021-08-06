<template>
    <div class="p-4 rounded shadow-lg">
        <h2>{{ title }}</h2>
        <p>{{ excerpt }}</p>

        <div class="flex space-x-4">
            <inertia-link :href="route('pipedrive.deal.add', {'title': title,})" class="px-6 py-4 bg-white shadow-lg rounded">Забрать</inertia-link>
        </div>
    </div>
</template>

<script>
import {InertiaLink} from '@inertiajs/inertia-vue3'

export default {
    components: {
        InertiaLink
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
    }
}
</script>

<style scoped>

</style>
