<template>
    <div class="container mx-auto mt-4">
        <div>
            <a :href="route('dashboard')" class="pb-4 border-white border-b-4 hover:border-green-500 cursor-pointer">
                <img class="inline relative text-green-500" src="/images/vasterra-logo.svg" alt="vasterra-logo" />
            </a>
        </div>
        <div class="flex items-center justify-start mt-6">
            <button
                class="set-kid ml-4 rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700"
                @click="isModalPicked = !isModalPicked">Set Kit</button>
            <button
                class="set-kid ml-4 rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 mr-7"
                @click="buildAnalytics">Build</button>
            <DateRangePicker class="mt-4"
                             v-model="dateRange"
                             @select="isDateRangeSelected = true"
            >
            </DateRangePicker>
        </div>
        <div class="mt-6" v-if="isBuildingInProgress">
            <h3 class="text-green-600">Building in progress, please wait...</h3>
        </div>
        <div v-if="data.length > 0" class="mt-8">
            <table>
                <tr>
                    <th></th>
                    <th v-for="innerItem in data[0].words" :key="innerItem.unique_id">{{ innerItem.word }}</th>
                </tr>
                <tr v-for="outerItem in data" :key="outerItem.unique_id" class="nth-child-1">
                    <td>{{ outerItem.country }}</td>
                    <td v-for="innerItem in outerItem.words" :key="innerItem.unique_id">{{ innerItem.count }}</td>
                </tr>
            </table>
        </div>

        <div class="min-w-full min-h-full z-10 bg-white absolute top-0 left-0 overflow-y-scroll p-8" :class="{ 'hidden': !isModalPicked }">
            <div class="flex justify-end items-center mb-2">
                <p class="text-black text-5xl close-kit cursor-pointer hover:text-red-500" @click="isModalPicked = false">×</p>
            </div>
            <div class="mb-10">
                <p class="text-lg font-bold text-black mb-3">Countries</p>
                <div class="flex flex-wrap justify-content-start items-start">
                    <button
                        class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        @click.stop="chooseAllItems(countriesList);"
                        :class="{ 'bg-green-500 text-white': allCountriesChecked }">
                        All country
                    </button>
                    <button
                        class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        v-for="country in countriesList"
                        :key="country.index"
                        @click.stop="country.checked = !country.checked; $forceUpdate();"
                        :class="{ 'bg-green-500 text-white': country.checked }">
                        {{ country.title }}
                    </button>
                </div>
            </div>
            <div class="mb-10">
                <p class="text-lg font-bold text-black mb-3">Key Words</p>
                <div class="flex flex-wrap justify-content-start items-start">
                    <button
                        class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        @click.stop="chooseAllItems(sortedKeyWords);"
                        :class="{ 'bg-green-500 text-white': allKeyWordsChecked }">
                        All Key Words
                    </button>
                    <button
                        v-for="(word, index) in sortedKeyWords"
                        class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        :class="{ 'bg-green-500 text-white': word.checked, 'font-bold': word.is_primary, 'mr-12': sortedKeyWords[index + 1] !== undefined && sortedKeyWords[index + 1].is_primary }"
                        @click.stop="word.checked = !word.checked; $forceUpdate();">
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
            <div class="flex flex-nowrap mb-10">
                <button class="rounded rounded-full bg-green-500 text-white py-3 px-4 hover:bg-green-700" @click="isModalPicked = false">Apply Kit</button>
                <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 ml-4" @click="resetAll">Cancel and reset</button>
            </div>
        </div>
    </div>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker'
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'

export default {
    name: "Analytics",
    components: {
        DateRangePicker,
    },
    props: {
        countries: {
            type: Array
        },
        keyWords: {
            type: Array
        }
    },
    data() {
        return {
            dateRange: {
                startData: '2020-01-01',
                endData: '2020-01-01',
            },
            countriesList: Object.seal(this.countries),
            keyWordsList: Object.seal(this.keyWords),
            isModalPicked: false,
            allCountriesChecked: false,
            allKeyWordsChecked: false,
            customKeyWords: [],
            newKeyWord: '',
            isDateRangeSelected: false,
            data: [],
            isBuildingInProgress: false,
        }
    },
    methods: {
        buildAnalytics() {
            this.isBuildingInProgress = true;
            let keyWords = [];
            this.keyWords.forEach((item) => {
                if (item.checked) keyWords.push(item.id);
            });
            let countries = [];
            this.countries.forEach((item) => {
                if (item.checked) countries.push(item.id);
            });
            if(!this.isDateRangeSelected || (keyWords.length < 1 && this.customKeyWords.length < 1) || countries.length < 1) {
                alert('You must pick date range and at least 1 country and 1 word.');
                return;
            }
            axios
                .post('/analytics/countries-key-words', {
                    dateRange: this.dateRange,
                    countries: countries,
                    keyWordsIds: keyWords,
                    customKeyWords: this.customKeyWords,
                })
                .then((res) => {
                    this.isBuildingInProgress = false;
                    this.data = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(error);
                });
        },
        resetAll() {
            this.customKeyWords = [];
            this.allCountriesChecked = false;
            this.allKeyWordsChecked = false;
            this.allCheck(this.countriesList, false);
            this.allCheck(this.sortedKeyWords, false);
        },
        chooseAllItems(obj) {
            switch (obj) {
                case this.countriesList:
                    this.allCountriesChecked ? this.allCheck(obj, false) : this.allCheck(obj, true);
                    this.allCountriesChecked = !this.allCountriesChecked;
                    break;
                case this.sortedKeyWords:
                    this.allKeyWordsChecked ? this.allCheck(obj, false) : this.allCheck(obj, true);
                    this.allKeyWordsChecked = !this.allKeyWordsChecked;
                    break;
            }
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
            let primaryKeyWords = this.keyWordsList.filter((item) =>{
                return item.is_primary;
            });
            let sortedKeyWords = [];
            for(const primaryWord of primaryKeyWords){
                sortedKeyWords.push(primaryWord);
                for(const word of this.keyWordsList){
                    if(primaryWord.id === word.parent_id){
                        sortedKeyWords.push(word);
                    }
                }
            }
            return sortedKeyWords;
        }
    }
}
</script>

<style scoped>
.set-kid {
    min-width: 120px;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}

table th {
    padding: 10px;
}

table td {
    padding: 10px;
}
</style>
