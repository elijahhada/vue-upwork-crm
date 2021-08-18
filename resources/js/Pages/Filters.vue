<template>
    <app-layout>
        <div class="container p-4 mx-auto bg-white">
            <div class="flex justify-around">
                <div class="w-5/12">
                    <multiselect v-model="wordsSearch" label="title" track-by="id" :multiple="true" :taggable="true" :options="words" @tag="addTag"></multiselect>
                </div>
                <div class="w-5/12">
                    <multiselect v-model="categoriesSearch" :options="categories" :multiple="true" group-values="topics" group-label="title" :group-select="true" placeholder="Type to search" track-by="id" label="title"></multiselect>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Multiselect from 'vue-multiselect'
    import "vue-multiselect/dist/vue-multiselect.min.css"

    export default {
        props: {
            categories: {
                type: Array,
                required: true,
            }
        },
        components: {
            AppLayout,
            Multiselect,
        },
        data() {
            return {
                words: [],
                categoriesSearch: [],
                wordsSearch: [],
            }
        },
        methods: {
            addTag (newTag) {
            const tag = {
                title: newTag,
                id: Math.floor((Math.random() * 10000000))
            }
            this.words.push(tag)
            this.wordsSearch.push(tag)
            }
        }
    }
</script>
