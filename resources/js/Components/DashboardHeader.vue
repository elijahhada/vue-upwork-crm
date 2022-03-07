<template>
    <div>
        <div class="w-full flex nowrap mb-8 mt-20">
            <div v-for="(user, key) in usersResults" :key="user.id" class="w-3/12 xl:w-3/12">
                <div class="flex justify-start items-start">
                    <img
                        :class="{ 'metal-badge': key === 3 }"
                        :src="key === 0 ? '/images/star-gold.svg' : key === 1 ? '/images/star-silver.svg' : key === 2 ? '/images/star-bronze.svg' : '/images/star-bronze.svg'"
                        alt="gold" />
                    <div class="flex flex-col items-start">
                        <p class="ml-2 font-bold mt-1">{{ user.name }}</p>
                        <p class="ml-2 mt-2 text-sm flex items-center"><span>{{ user.total }}</span><span> → </span> <span>{{ user.conversion }}%</span><span> → </span><span>{{ user.answers }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full my-12 flex justify-between items-center">
            <div class="block-kit flex items-center flex-wrap gap-y-3 flex-shrink z-50" ref="block_kit">
                <button class="create-kid rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 mr-7" @click.stop="showKitForm()">Create Kit</button>
                <div class="relative" v-for="filter in filtersArr">
                    <div
                        class="bg-gray-200 text-black rounded font-normal mr-6 flex items-center"
                        :class="{ 'bg-green-500 text-white': selectedKits.includes(filter.id) }">
                        <p class="rounded-l py-3 px-3 cursor-pointer hover:bg-green-500 hover:text-white w-max" @click="toggleSelectedKits(filter.id)">{{ filter.title }}</p>
                        <button class="rounded-r open-filters py-3 px-3 border-l border-gray-400 cursor-pointer hover:bg-green-500 hover:text-white" @click.stop="showFilterFrom(filter)">...</button>
                    </div>
                </div>
            </div>
        </div>
        <kit-modal @refresh-filters="$emit('refresh-filters')" v-if="showKit" v-on:disable-kit="closeKit" :countries="countries" :categories="categories" :keyWords="keyWords" :userId="userId"></kit-modal>
        <filter-modal @refresh-filters="$emit('refresh-filters')" v-if="FiltersVisibility" v-on:disable-filter="closeFilter" :filter="SelectedFilter" :filterCountries="countries" :filterCategories="categories" :filterKeyWords="keyWords" :userId="userId"></filter-modal>
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
        keyWords: {
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
        usersResults: {
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
        }
    },
    computed: {
        filtersArr() {
            return this.filters;
        }
    }
};
</script>
<style scoped>
.metal-badge {
    filter: invert(72%) sepia(26%) saturate(1025%) hue-rotate(350deg) brightness(85%) contrast(83%);
}
</style>
