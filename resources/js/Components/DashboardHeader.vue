<template><div>
                    <div class="w-full flex nowrap mb-8 mt-20">
                    <div class="w-4/12 xl:w-3/12">
                        <div class="flex justify-start items-start">
                            <img src="images/star-gold.svg" alt="gold">
                            <div class="flex flex-col items-start">
                                <p class="ml-2 font-bold mt-1 ">Artem </p>
                                <p class="ml-2 mt-2 text-sm flex items-center">
                                    <span>112</span><span> → </span> <span>75%</span><span> → </span><span>84</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 xl:w-3/12">
                        <div class="flex justify-start items-start">
                            <img src="images/star-silver.svg" alt="silver">
                            <div class="flex flex-col items-start">
                                <p class="ml-2 font-bold mt-1 ">Olga </p>
                                <p class="ml-2 mt-2 text-sm flex items-center">
                                    <span>87</span><span> → </span> <span>66,7%</span><span> → </span><span>58</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 xl:w-3/12">
                        <div class="flex justify-start items-start">
                            <img src="images/star-bronze.svg" alt="bronze">
                            <div class="flex flex-col items-start">
                                <p class="ml-2 font-bold mt-1 ">Stepan </p>
                                <p class="ml-2 mt-2 text-sm flex items-center p-0">
                                    <span>57</span><span> → </span> <span>56,1%</span><span> → </span><span>32</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="w-full my-12 flex justify-between items-center nowrap">
                    <div class="block-kit flex justify-start items-center nowrap w-6/12 flex-shrink " ref="block_kit">
                        <button class="create-kid rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 mr-7" @click="showKitForm()">
                            Create
                            Kit
                        </button>
                        <div class="relative"
                             v-for="filter in filtersArr"
                        >
                            <div class=" bg-gray-200 text-black rounded  px-3 font-normal mr-6 hover:bg-green-500 hover:text-white  flex items-center ">
                                <p class="mr-2">{{filter.title}}</p>
                                <button class="open-filters  py-3 pl-3  pr-1 border-l border-gray-400 cursor-pointer"  @click="showFilterFrom">
                                    ...
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="parent-search-block flex nowrap w-6/12 flex justify-end flex-grow items-center" ref='parent_search_block'>
                        <div class="w-0 overflow-hidden flex justify-between  search-block " ref="search_block">
                            <input type="text" placeholder="Job id, URL,Title or key word"
                                   class="w-11/12 search-input  border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none placeholder-gray-300">
                            <button class=" rounded rounded-full bg-gray-300 text-black py-3 px-9 hover:bg-green-500 hover:text-white">
                                Search
                            </button>
                            <p class="ml-4 search-button text-black text-5xl  cursor-pointer hover:text-red-500" @click="closeSearch()"
                               title="Close search panel">×</p>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             class="cursor-pointer search" title="Open search panel" @click="showSearch()" ref="search">
                            <path id="search-svg" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M14.618 16.032C13.0243 17.309 11.0422 18.0033 9 18C6.61305 18 4.32387 17.0518 2.63604 15.364C0.948211 13.6761 0 11.3869 0 9C0 6.61305 0.948211 4.32387 2.63604 2.63604C4.32387 0.948211 6.61305 0 9 0C11.3869 0 13.6761 0.948211 15.364 2.63604C17.0518 4.32387 18 6.61305 18 9C18.0033 11.0422 17.309 13.0243 16.032 14.618L24 22.586L22.586 24L14.618 16.032ZM9 2C12.86 2 16 5.14 16 9C16 12.86 12.86 16 9 16C5.14 16 2 12.86 2 9C2 5.14 5.14 2 9 2Z"
                                  fill="black"/>
                        </svg>

                    </div>
                </div>
                <kit-modal
                    v-if="showKit"
                    v-on:disable-kit="closeKit"
                    :countries="countries"
                    :categories="categories"
                    :userId="userId"
                ></kit-modal>
                <filter-modal v-if="FiltersVisibility" v-on:disable-filter="FiltersVisibility = !FiltersVisibility"></filter-modal>
</div>
</template>

<script>
import kitModal from './Modals/CreateKit'
import filterModal from './Modals/FiltersModal'

export default{
    props: {
        filters: {
            type: Array,
            required: false
        },
        countries: {
            type: Array,
            required: true
        },
        categories: {
            type: Array,
            required: true
        },
        userId: {
            type: Number
        }
    },
    data(){
        return{
            showKit: false,
            FiltersVisibility: false,
            filtersArr: this.filters
        }
    },
    components:{
        kitModal,
        filterModal
    },
    methods:{
        showSearch(){
                this.$refs.search_block.classList.remove('w-0')
                this.$refs.search_block.classList.add('w-full')
                this.$refs.search_block.style.cssText = 'animation: width100 .3s linear'
                setTimeout(() => {

                    this.$refs.search_block.classList.add('w-full')
                }, 280)

                this.$refs.parent_search_block.classList.remove('w-6/12')
                this.$refs.parent_search_block.classList.add('w-full')
                this.$refs.block_kit.classList.remove('w-6/12')
                this.$refs.block_kit.classList.add('w-0', 'overflow-hidden')

                this.$refs.search.classList.add('hidden')
            },
        closeSearch(){
            this.$refs.search_block.cssText = 'animation: width0 .3s linear'
            setTimeout(() => {
                this.$refs.search_block.classList.remove('w-full')
                this.$refs.search_block.classList.add('w-0')
                this.$refs.search.classList.remove('hidden')

                this.$refs.parent_search_block.classList.remove('w-full')
                this.$refs.parent_search_block.classList.add('w-6/12')
                this.$refs.block_kit.classList.remove('w-0', 'overflow-hidden')
                this.$refs.block_kit.classList.add('w-6/12')
            }, 10)
        },
        showKitForm(){
            this.showKit = !this.showKit
        },
        showFilterFrom(){
            this.FiltersVisibility = !this.FiltersVisibility
        },
        closeKit(event) {
            this.showKit = !this.showKit
            if(event) this.filtersArr.push(event)
        }
    }
}
</script>
