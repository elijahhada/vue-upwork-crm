<template>
    <div class="flex rounded shadow-lg bg-white items-center">
        <div class="w-8/12 p-4">
            <div class="flex space-x-8">
                <div class="text-gray-500 text-sm"><span>{{ dateCreated }}</span> - <span>{{ diffHuman }}</span></div>
                <div><span class="font-bold">{{ category }}</span> &#8594; <span class="text-gray-700">{{ subCategory }}</span></div>
            </div>
            <div class="flex items-center">
                <h2 class="py-3 text-xl font-bold">
                    <a target="_blank" :href="url">{{ title }}</a>
                </h2>
                &nbsp;&#8594;&nbsp;
                <div class="lowercase text-gray-700">
                    <span>{{ jobType }}</span>
                    /
                    <span>${{ budget }}</span>
                </div>
            </div>
            <p class="pb-5 text-gray-700" v-if="truncated && excerpt.length > truncatedLength">{{ truncatedExcerpt }} <span @click="truncated = false" class="cursor-pointer underline">...</span></p>
            <p class="pb-5 text-gray-700" v-else>{{ excerpt }} <span v-if="!truncated && excerpt.length > truncatedLength" @click="truncated = true" class="cursor-pointer underline">hide</span></p>

            <div class="flex space-x-4">
                <button @click="showModal" class="px-6 py-4 bg-white shadow-lg rounded">Забрать</button>
            </div>
        </div>
        <div class="w-4/12 text-center border-l p-4">
            <h2 class="text-xl pb-4 font-bold">Client info</h2>

            <div class="rounded-full w-32 h-32 border-8 mx-auto relative" :class="{'border-green-400': score >= 60, 'border-yellow-400': score >= 40 && score < 60, 'border-red-400': score < 40}">
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <p class="text-6xl font-bold">{{ score }}</p>
                </div>
            </div>

            <div class="pt-4">
                <p class="font-bold">Client feedback score: <span class="text-gray-700">{{ feedback }}</span></p>
                <p class="font-bold">Client country: <span class="text-gray-700">{{ country }}</span></p>
                <p class="font-bold">Client payment verification: <span class="text-gray-700">{{ verification }}</span></p>
            </div>
        </div>
    </div>
</template>

<script>
import AddDeal from "../Modals/AddDeal";

export default {
    components: {
    },
    computed: {
        truncatedExcerpt: function() {
            return this.excerpt.substring(0, this.truncatedLength);
        }
    },
    props: {
        title: {
            required: true,
            type: String,
        },
        excerpt: {
            required: true,
            type: String,
        },
        score: {
            required: true,
            type: Number,
        },
        feedback: {
            required: true,
            type: String,
        },
        country: {
            required: true,
            type: String,
        },
        dateCreated: {
            required: true,
            type: String,
        },
        diffHuman: {
            required: true,
            type: String,
        },
        category: {
            required: true,
            type: String,
        },
        subCategory: {
            required: true,
            type: String,
        },
        jobType: {
            required: true,
            type: String,
        },
        verification: {
            required: true,
            type: String,
        },
        budget: {
            required: true,
            type: String,
        },
        url: {
            required: true,
            type: String,
        },
    },
    data() {
        return {
            truncatedLength: 300,
            truncated: true,
        }
    },
    methods: {
        showModal() {
            this.$inertia.get(this.route('pipedrive.deal.add'));
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
