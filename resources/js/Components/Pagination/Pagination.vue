<template>
    <ul class="flex flex-wrap items-center">
        <li class="mt-2">
            <button
                @click="changePage(data.current_page !== 1 ? data.current_page - 1 : 1)"
                class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal active-button"
                :disabled="data.current_page === 1"
            >&laquo; Prev</button>
        </li>
        <li v-for="page in computedPages" :key="page" class="mt-2 ml-2">
            <button
                @click="changePage(page)"
                class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal active-button"
                :class="{ 'bg-green-500 text-white': data.current_page === page }"
            >{{ page }}</button>
        </li>
        <li class="mt-2 ml-2">
            <button
                @click="changePage(data.current_page !== data.last_page ? data.current_page + 1 : data.last_page)"
                class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal active-button"
                :disabled="data.current_page === data.last_page"
            >Next &raquo;</button>
        </li>
        <li class="flex mt-2 ml-4">
            <button @click="changePage(goTo)" class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded-l py-3 px-4 font-normal active-button">Go to</button>
            <input type="text" class="p-2 border border-gray-300 rounded-r focus:outline-none" style="width: 47px;" v-model="goTo">
            <span class="flex items-center">
                <span>last: {{ data.last_page }}</span>
            </span>
        </li>
        <li class="mt-2 ml-2">
            <span>On page</span>
            <select name="" id="" class="p-2 border border-gray-300 rounded-md focus:outline-none" style="width: 60px;" v-model="onPage" @change="changeOnPage">
                <option :value="10">10</option>
                <option :value="20">20</option>
                <option :value="30">30</option>
            </select>
        </li>
    </ul>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    mounted() {

    },
    data() {
        return {
            goTo: 1,
            onPage: 10,
        }
    },
    methods: {
        changeOnPage() {
            this.changePage(1);
        },
        changePage(page) {
            this.$emit('change-page', { page: page, onPage: this.onPage });
        }
    },
    computed: {
        computedPages() {
            const start = this.data.current_page <= 3 ? 1 : this.data.current_page - 2;
            const end = this.data.last_page - this.data.current_page > 2 ? this.data.current_page + 2  : this.data.last_page;
            const range = [];
            for (let i=start; i <= end; i++) {
                range.push(i);
            }
            return range;
        }
    }
}
</script>

<style scoped>
</style>
