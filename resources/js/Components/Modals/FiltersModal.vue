<template>
    <section id="manager-filters" class="w-full overflow-y-scroll bg-white p-8 h-screen z-50 fixed top-0 left-0 right-0">
        <div class="flex justify-between items-center mb-2">
            <p class="text-2xl text-black font-bold">{{ filter.title }}</p>
            <p class="text-black text-5xl close-kit cursor-pointer hover:text-red-500" @click="closeFilter()">×</p>
        </div>
        <p class="cursor-pointer hover:bg-red-500 hover:text-white bg-gray-200 text-black rounded py-1 px-4 font-normal inline-block mb-2" @click="removeFilter(filter)">delete kit</p>
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
                    v-for="word in keyWords"
                    class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    :class="{ 'bg-green-500 text-white': word.checked }"
                    @click.stop="
                        word.checked = !word.checked;
                        $forceUpdate();
                    ">
                    {{ word.title }}
                </button>
            </div>
        </div>

        <div class="mb-7">
            <p class="text-lg font-bold text-black mb-3">Exception words</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button
                    class="cursor-pointer bg-gray-200 text-black rounded px-3 font-normal mr-4 hover:bg-green-500 hover:text-white flex items-center active-button"
                    v-for="(word, index) in exseptionWords">
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
            exseptionWords: [],
            newWord: '',
            countries: Object.seal(this.filterCountries),
            categories: Object.seal(this.filterCategories),
            keyWords: Object.seal(this.filterKeyWords),
            allCountriesChecked: false,
            allCategoriesChecked: false,
            allKeyWordsChecked: false,
        };
    },
    mounted() {
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
        if (filter.exseption_words) {
            filter.exseption_words.split('_|_').forEach((item) => {
                this.exseptionWords.push(item);
            });
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
            if (this.newWord != false) this.exseptionWords.push(this.newWord.trim());
            this.newWord = '';
            this.closeAddWord();
        },
        deleteWord(i) {
            this.exseptionWords.splice(i, 1);
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
            if (!countries.length && !categories.length && !keyWords.length && !this.exseptionWords.length) return alert('Введите параметр(ы) фильтра!');

            axios.post('/update-filter', {
                id: this.filter.id,
                user_id: this.userId,
                title: this.createdKitTitle,
                countries_ids: countries.join(','),
                categories_ids: categories.join(','),
                key_words_ids: keyWords.join(','),
                exseption_words: this.exseptionWords.join('_|_'),
            }).then(res => {
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
    },
};
</script>
