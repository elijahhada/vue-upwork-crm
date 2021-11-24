<template>
    <div>
        <div class="w-full flex nowrap mb-8 mt-20">
            <div class="w-4/12 xl:w-3/12">
                <div class="flex justify-start items-start">
                    <img src="/images/star-gold.svg" alt="gold" />
                    <div class="flex flex-col items-start">
                        <p class="ml-2 font-bold mt-1">Artem</p>
                        <p class="ml-2 mt-2 text-sm flex items-center"><span>112</span><span> → </span> <span>75%</span><span> → </span><span>84</span></p>
                    </div>
                </div>
            </div>
            <div class="w-4/12 xl:w-3/12">
                <div class="flex justify-start items-start">
                    <img src="/images/star-silver.svg" alt="silver" />
                    <div class="flex flex-col items-start">
                        <p class="ml-2 font-bold mt-1">Olga</p>
                        <p class="ml-2 mt-2 text-sm flex items-center"><span>87</span><span> → </span> <span>66,7%</span><span> → </span><span>58</span></p>
                    </div>
                </div>
            </div>
            <div class="w-4/12 xl:w-3/12">
                <div class="flex justify-start items-start">
                    <img src="/images/star-bronze.svg" alt="bronze" />
                    <div class="flex flex-col items-start">
                        <p class="ml-2 font-bold mt-1">Stepan</p>
                        <p class="ml-2 mt-2 text-sm flex items-center p-0"><span>57</span><span> → </span> <span>56,1%</span><span> → </span><span>32</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full my-12 flex justify-between items-center nowrap">
            <div class="block-kit flex justify-start items-center nowrap w-6/12 flex-shrink" ref="block_kit">
                <button class="create-kid rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 mr-7" @click.stop="showKitForm()">Create Kit</button>
                <div class="relative" v-for="filter in filtersArr">
                    <div
                        class="bg-gray-200 text-black rounded px-3 font-normal mr-6 hover:bg-green-500 hover:text-white flex items-center"
                        :class="{ 'bg-green-500 text-white': selectedKits.includes(filter.id) }">
                        <p class="mr-2 cursor-pointer" @click="toggleSelectedKits(filter.id)">{{ filter.title }}</p>
                        <button class="open-filters py-3 pl-3 pr-1 border-l border-gray-400 cursor-pointer" @click.stop="showFilterFrom(filter)">...</button>
                        <button class="py-3 pl-3 pr-1 border-l border-gray-400 cursor-pointer" @click.stop="removeFilter(filter)">&times;</button>
                    </div>
                </div>
            </div>
        </div>
        <kit-modal v-if="showKit" v-on:disable-kit="closeKit" :countries="countries" :categories="categories" :userId="userId"></kit-modal>
        <filter-modal v-if="FiltersVisibility" v-on:disable-filter="closeFilter" :filter="SelectedFilter" :filterCountries="countries" :filterCategories="categories" :userId="userId"></filter-modal>
    </div>
</template>

<script>
import kitModal from './Modals/CreateKit';
import filterModal from './Modals/FiltersModal';

export default {
    props: {
        filters: {
            type: Array,
            required: false,
        },
        countries: {
            type: Array,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
        userId: {
            type: Number,
        },
        selectedKits: {
            type: Array,
            required: true,
        },
    },
    model: {
        prop: 'selectedKits',
        event: 'change',
    },
    data() {
        return {
            showKit: false,
            FiltersVisibility: false,
            filtersArr: this.filters,
            SelectedFilter: null,
            dataSelectedKits: [],
        };
    },
    components: {
        kitModal,
        filterModal,
    },
    methods: {
        toggleSelectedKits(filterId) {
            if (this.dataSelectedKits.includes(filterId)) {
                this.dataSelectedKits.splice(this.dataSelectedKits.indexOf(filterId), 1);
            } else {
                this.dataSelectedKits.push(filterId);
            }
            this.$emit('change', this.dataSelectedKits);
        },
        showSearch() {
            this.$refs.search_block.classList.remove('w-0');
            this.$refs.search_block.classList.add('w-full');
            this.$refs.search_block.style.cssText = 'animation: width100 .3s linear';
            setTimeout(() => {
                this.$refs.search_block.classList.add('w-full');
            }, 280);

            this.$refs.parent_search_block.classList.remove('w-6/12');
            this.$refs.parent_search_block.classList.add('w-full');
            this.$refs.block_kit.classList.remove('w-6/12');
            this.$refs.block_kit.classList.add('w-0', 'overflow-hidden');

            this.$refs.search.classList.add('hidden');
        },
        closeSearch() {
            this.$refs.search_block.cssText = 'animation: width0 .3s linear';
            setTimeout(() => {
                this.$refs.search_block.classList.remove('w-full');
                this.$refs.search_block.classList.add('w-0');
                this.$refs.search.classList.remove('hidden');

                this.$refs.parent_search_block.classList.remove('w-full');
                this.$refs.parent_search_block.classList.add('w-6/12');
                this.$refs.block_kit.classList.remove('w-0', 'overflow-hidden');
                this.$refs.block_kit.classList.add('w-6/12');
            }, 10);
        },
        showKitForm() {
            this.showKit = !this.showKit;
            document.body.classList.add('overflow-y-hidden');
        },
        showFilterFrom(filter) {
            this.FiltersVisibility = !this.FiltersVisibility;
            document.body.classList.add('overflow-y-hidden');
            this.SelectedFilter = filter;
        },
        closeFilter(filter) {
            this.FiltersVisibility = !this.FiltersVisibility;
            document.body.classList.remove('overflow-y-hidden');
        },
        closeKit(event) {
            this.showKit = !this.showKit;
            document.body.classList.remove('overflow-y-hidden');
            if (event) this.filtersArr.push(event);
        },
        removeFilter(filter) {
            if (filter.user_id !== this.userId) return alert('Удалять фильтр может только его создатель!');

            axios.post('/remove-filter', {
                id: filter.id,
                user_id: this.userId,
            }).then(res => {
                console.log(res);
                socket.emit('kits:speak', {});
            });
            return alert('Filter was removed!');
        }
    },
};
</script>
