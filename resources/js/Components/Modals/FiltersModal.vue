<template>
    <section id="manager-filters" class="w-full overflow-y-scroll bg-white p-8 h-screen z-50 fixed top-0 left-0 right-0">
        <div class="flex justify-between items-center mb-2">
            <p class="text-2xl text-black font-bold">{{ filter.title }}</p>
            <p class="text-black text-5xl close-kit cursor-pointer hover:text-red-500" @click="closeFilter()">×</p>
        </div>
        <p class="cursor-pointer hover:bg-red-500 hover:text-white bg-gray-200 text-black rounded py-1 px-4 font-normal inline-block mb-2" @click="removeFilter(filter)">delete kit</p>
        <p class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-1 px-4 font-normal inline-block mb-2 ml-4" @click="copyFilter">copy kit</p>
        <input type="text" v-model="newTitle" class="border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" placeholder="pick title">
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Job type</p>
            <div class="flex items-center justify-between w-2/5">
                <div class="flex">
                    <input type="checkbox" class="mr-4 border rounded border-gray-400 p-4" v-model="is_hourly">
                    <span class="mr-4">Hourly</span>
                </div>
                <div class="flex">
                    <input type="text" v-model="hourly_min" :disabled="!is_hourly" :class="{ 'bg-gray-200': !is_hourly }" class="border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" placeholder="min">
                    <input type="text" v-model="hourly_max" :disabled="!is_hourly" :class="{ 'bg-gray-200': !is_hourly }" class="border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" placeholder="max">
                </div>
            </div>
            <div class="flex items-center justify-between w-2/5 mt-2">
                <div class="flex">
                    <input type="checkbox" class="mr-4 border rounded border-gray-400 p-4" v-model="is_fixed">
                    <span class="mr-4">Fixed-Price</span>
                </div>
                <div class="flex">
                    <input type="text" v-model="fixed_min" :disabled="!is_fixed" :class="{ 'bg-gray-200': !is_fixed }" class="border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" placeholder="min">
                    <input type="text" v-model="fixed_max" :disabled="!is_fixed" :class="{ 'bg-gray-200': !is_fixed }" class="border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" placeholder="max">
                </div>
            </div>
        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Countries</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    @click.stop="
                        chooseAllItems(countries);
                        $forceUpdate();
                    "
                    :class="{ 'bg-green-500 text-white': allCountriesChecked }">
                    All country
                </button>
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    v-for="country in countries"
                    :key="country.index"
                    @click.stop="
                        country.checked = !country.checked;
                        $forceUpdate();
                    "
                    :class="{ 'bg-green-500 text-white': country.checked }">
                    {{ country.title }}
                </button>
            </div>
        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Categories</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    @click.stop="
                        chooseAllItems(categories);
                        $forceUpdate();
                    "
                    :class="{ 'bg-green-500 text-white': allCategoriesChecked }">
                    All categories
                </button>
                <button
                    v-for="category in categories"
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    :class="{ 'bg-green-500 text-white': category.checked }"
                    @click.stop="
                        category.checked = !category.checked;
                        $forceUpdate();
                    ">
                    {{ category.title }}
                </button>
            </div>
        </div>

        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Key Words</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    @click.stop="
                        chooseAllItems(keyWords);
                        $forceUpdate();
                    "
                    :class="{ 'bg-green-500 text-white': allKeyWordsChecked }">
                    All Key Words
                </button>
                <button
                    v-for="(word, index) in sortedKeyWords"
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    :class="{ 'bg-green-500 text-white': word.checked, 'font-bold': word.is_primary, 'mr-12': sortedKeyWords[index + 1] !== undefined && sortedKeyWords[index + 1].is_primary }"
                    @click.stop="
                        word.checked = !word.checked;
                        $forceUpdate();
                    ">
                    {{ word.title }}
                </button>
            </div>
        </div>

        <div class="mb-7">
            <p class="text-lg font-bold text-black mb-3">Custom Key Words</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer bg-gray-200 text-black rounded px-3 font-normal mr-4 hover:bg-green-500 hover:text-white flex items-center active-button"
                    v-for="(word, index) in customKeyWords">
                    <p class="mr-2">{{ word }}</p>
                    <p class="py-2 pl-3 pr-1 border-l border-gray-400 exception-key-words text-2xl hover:text-red-500" title="Delete word" @click="deleteKeyWord(index)">×</p>
                </button>
            </div>
        </div>
        <div class="mb-12 flex nowrap">
            <input type="text" placeholder="New word" class="input-key-word hidden border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" v-model="newKeyWord" />
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 add-key-word" @click.stop="openAddKeyWord()">+ Add word</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 save-key-word-input hidden mr-4" @click.stop="saveKeyWord()">Save</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 close-key-word-input hidden" @click.stop="closeAddKeyWord()">Close</button>
        </div>

        <div class="mb-7">
            <p class="text-lg font-bold text-black mb-3">Exception words</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer bg-gray-200 text-black rounded px-3 font-normal mr-4 hover:bg-green-500 hover:text-white flex items-center active-button"
                    v-for="(word, index) in exceptionWords">
                    <p class="mr-2">{{ word }}</p>
                    <p class="py-2 pl-3 pr-1 border-l border-gray-400 exception-words text-2xl hover:text-red-500" title="Delete word" @click="deleteWord(index)">×</p>
                </button>
            </div>
        </div>
        <div class="mb-12 flex nowrap">
            <input type="text" placeholder="New word" class="input-word hidden border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" v-model="newWord" />
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 add-word" @click.stop="openAddWord()">+ Add word</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 save-word-input hidden mr-4" @click.stop="saveWord()">Save</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 close-word-input hidden" @click.stop="closeAddWord()">Close</button>
        </div>

        <div class="flex nowrap mb-12">
            <input type="text" placeholder="Name kit" class="input-kit border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none" v-model="createdKitTitle" />

            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700" @click.stop="saveKit()">Update Kit</button>
        </div>
    </section>
</template>
<script>
export default {
    props: {
        filter: {
            type: Object,
        },
        filterCountries: {
            type: Array,
        },
        filterCategories: {
            type: Array,
        },
        filterKeyWords: {
            type: Array,
        },
        userId: {
            type: Number,
        },
    },
    data() {
        return {
            createdKitTitle: '',
            exceptionWords: [],
            customKeyWords: [],
            newWord: '',
            newKeyWord: '',
            countries: Object.seal(this.filterCountries),
            categories: Object.seal(this.filterCategories),
            keyWords: Object.seal(this.filterKeyWords),
            allCountriesChecked: false,
            allCategoriesChecked: false,
            allKeyWordsChecked: false,
            is_hourly: false,
            hourly_min: 0,
            hourly_max: 0,
            is_fixed: false,
            fixed_min: 0,
            fixed_max: 0,
            newTitle: 'pick new title',
        };
    },
    mounted() {
        this.is_hourly = this.filter.is_hourly;
        this.hourly_min = this.filter.hourly_min;
        this.hourly_max = this.filter.hourly_max;
        this.is_fixed = this.filter.is_fixed;
        this.fixed_min = this.filter.fixed_min;
        this.fixed_max = this.filter.fixed_max;
        let filter = this.filter;
        if (filter.countries_ids) {
            this.countries.forEach((item) => {
                if (filter.countries_ids.split(',').map(Number).includes(item.id)) item.checked = !item.checked;
            });
        }
        if (filter.categories_ids) {
            this.categories.forEach((item) => {
                if (filter.categories_ids.split(',').map(Number).includes(item.id)) item.checked = !item.checked;
            });
        }
        if (filter.key_words_ids) {
            this.keyWords.forEach((item) => {
                if (filter.key_words_ids.split(',').map(Number).includes(item.id)) item.checked = !item.checked;
            });
        }
        if (filter.exception_words_ids) {
            filter.exception_words_ids.split(',').forEach((item) => {
                this.exceptionWords.push(item);
            });
        }
        if (filter.custom_key_words_ids) {
            filter.custom_key_words_ids.split(',').forEach((item) => {
                this.customKeyWords.push(item);
            });
        }
        if(this.countries.every(v => v.checked)) {
            this.allCountriesChecked = true;
        }
        if(this.categories.every(v => v.checked)) {
            this.allCategoriesChecked = true;
        }
        if(this.keyWords.every(v => v.checked)) {
            this.allKeyWordsChecked = true;
        }
        this.createdKitTitle = filter.title;
        this.$forceUpdate();
        console.log(filter);
    },
    methods: {
        chooseAllItems(obj) {
            switch (obj) {
                case this.countries:
                    this.allCountriesChecked ? this.allCheck(obj, false) : this.allCheck(obj, true);
                    this.allCountriesChecked = !this.allCountriesChecked;
                    break;
                case this.categories:
                    this.allCategoriesChecked ? this.allCheck(obj, false) : this.allCheck(obj, true);
                    this.allCategoriesChecked = !this.allCategoriesChecked;
                    break;
                case this.keyWords:
                    this.allKeyWordsChecked ? this.allCheck(obj, false) : this.allCheck(obj, true);
                    this.allKeyWordsChecked = !this.allKeyWordsChecked;
                    break;
            }
        },
        openAddWord() {
            document.querySelector('.add-word').classList.add('hidden');
            document.querySelector('.input-word').classList.remove('hidden');
            document.querySelector('.close-word-input').classList.remove('hidden');
            document.querySelector('.save-word-input').classList.remove('hidden');
        },
        closeAddWord() {
            document.querySelector('.add-word').classList.remove('hidden');
            document.querySelector('.input-word').classList.add('hidden');
            document.querySelector('.close-word-input').classList.add('hidden');
            document.querySelector('.save-word-input').classList.add('hidden');
        },
        saveWord() {
            if (this.newWord != false && this.newWord.length > 0) this.exceptionWords.push(this.newWord.trim());
            this.newWord = '';
            this.closeAddWord();
        },
        deleteWord(i) {
            this.exceptionWords.splice(i, 1);
        },
        openAddKeyWord() {
            document.querySelector('.add-key-word').classList.add('hidden');
            document.querySelector('.input-key-word').classList.remove('hidden');
            document.querySelector('.close-key-word-input').classList.remove('hidden');
            document.querySelector('.save-key-word-input').classList.remove('hidden');
        },
        closeAddKeyWord() {
            document.querySelector('.add-key-word').classList.remove('hidden');
            document.querySelector('.input-key-word').classList.add('hidden');
            document.querySelector('.close-key-word-input').classList.add('hidden');
            document.querySelector('.save-key-word-input').classList.add('hidden');
        },
        saveKeyWord() {
            if (this.newKeyWord != false && this.newKeyWord.length > 0) this.customKeyWords.push(this.newKeyWord.trim());
            this.newKeyWord = '';
            this.closeAddKeyWord();
        },
        deleteKeyWord(i) {
            this.customKeyWords.splice(i, 1);
        },
        saveKit() {
            if (this.userId !== this.filter.user_id) return alert('Обновлять фильтр может только его создатель!');
            let countries = [];
            this.countries.forEach((item) => {
                if (item.checked) countries.push(item.id);
            });

            let categories = [];
            this.categories.forEach((item) => {
                if (item.checked) categories.push(item.id);
            });

            let keyWords = [];
            this.keyWords.forEach((item) => {
                if (item.checked) keyWords.push(item.id);
            });

            if (!this.createdKitTitle) return alert('Введите название фильтра!');
            if (!countries.length && !categories.length && !keyWords.length && !this.exceptionWords.length
                && !this.customKeyWords.length && this.hourly_min < 1 && this.hourly_max < 1 && this.fixed_min < 1 && this.fixed_max < 1) return alert('Введите параметр(ы) фильтра!');

            const data = {
                id: this.filter.id,
                user_id: this.userId,
                title: this.createdKitTitle,
                countries_ids: countries.join(','),
                categories_ids: categories.join(','),
                key_words_ids: keyWords.join(','),
                exception_words_ids: this.exceptionWords.join(','),
                custom_key_words_ids: this.customKeyWords.join(','),
                is_hourly: this.is_hourly,
                hourly_min: this.hourly_min,
                hourly_max: this.hourly_max,
                is_fixed: this.is_fixed,
                fixed_min: this.fixed_min,
                fixed_max: this.fixed_max,
            }
            axios.post('/update-filter', data).then(res => {
                socket.emit('kits:speak', {});
            });
            return alert('Filter was updated!');
        },
        closeFilter() {
            let filter = this.filter;
            this.categories.forEach((item) => {
                if (item.checked) item.checked = !item.checked;
            });
            this.countries.forEach((item) => {
                if (item.checked) item.checked = !item.checked;
            });
            this.$forceUpdate();
            this.$emit('disable-filter', this.filter);
        },
        removeFilter(filter) {
            if (filter.user_id !== this.userId) return alert('Удалять фильтр может только его создатель!');

            if (!confirm('Are you sure?')) return;
            axios.post('/remove-filter', {
                id: filter.id,
                user_id: this.userId,
            }).then(res => {
                console.log(res);
                socket.emit('kits:speak', {});
            });
            return alert('Filter was removed!');
        },
        copyFilter() {
            if (!confirm('Are you sure?')) return;
            axios.post('/copy-filter', {
                id: this.filter.id,
                user_id: this.userId,
                title: this.newTitle,
            }).then(res => {
                console.log(res);
                alert('Filter was duplicated successfully.');
                this.$emit('refresh-filters');
            }).catch(error => {
                console.log(error);
            });
        }
    },
    computed: {
        allCheck(obj, val) {
            return (obj, val) => {
                obj.forEach((item) => {
                    item.checked = val;
                });
            };
        },
        sortedKeyWords() {
            let primaryKeyWords = this.keyWords.filter((item) =>{
                return item.is_primary;
            });
            let sortedKeyWords = [];
            for(const primaryWord of primaryKeyWords){
                sortedKeyWords.push(primaryWord);
                for(const word of this.keyWords){
                    if(primaryWord.id === word.parent_id){
                        sortedKeyWords.push(word);
                    }
                }
            }
            return sortedKeyWords;
        }
    },
};
</script>
