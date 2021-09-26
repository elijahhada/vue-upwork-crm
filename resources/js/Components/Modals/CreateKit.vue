<template>
<div>
    <section id="create-kit" class="w-full bg-white p-8 min-h-screen z-50 absolute top-0 left-0 right-0">
        <div class="flex justify-between items-center mb-8">
            <p class="text-2xl text-black font-bold">Create Kit</p>
            <p class="text-black text-5xl close-kit cursor-pointer hover:text-red-500" @click="closeKit()">×</p>
        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Countries</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        @click="chooseAllItems(countries); $forceUpdate()"
                        :class="{'bg-green-500 text-white' : allCountriesChecked}"
                >
                    All country
                </button>
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    v-for="(country, index) in countries"
                    :key="country.index"
                    @click="country.checked = !country.checked; $forceUpdate()"
                    :class="{'bg-green-500 text-white': country.checked}"
                >
                    {{country.title}}
                </button>
            </div>
        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Categories</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                        @click="chooseAllItems(categories); $forceUpdate()"
                        :class="{'bg-green-500 text-white' : allCategoriesChecked}"
                >
                    All categories
                </button>
                <button
                    class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button"
                    v-for="category in categories"
                    :key="category.index"
                    @click="category.checked = !category.checked; $forceUpdate()"
                    :class="{'bg-green-500 text-white': category.checked}"
                >
                    {{category.title}}
                </button>
            </div>
        </div>

        <div class="mb-7">
            <p class="text-lg font-bold text-black mb-3">Exception words</p>
            <div class="flex flex-wrap justify-content-start items-start">
                <button class="cursor-pointer bg-gray-200 text-black rounded  px-3 font-normal mr-4 hover:bg-green-500 hover:text-white flex items-center active-button"
                        v-for="(word,index) in exseptionWords"
                >
                    <p class="mr-2">{{word}}</p>
                    <p class="  py-2 pl-3 pr-1 border-l border-gray-400 exception-words text-2xl hover:text-red-500"
                       title="Delete word"
                       @click="deleteWord(index)"
                    >×</p>
                </button>
            </div>

        </div>
        <div class="mb-12 flex nowrap">
            <input type="text" placeholder="New word"
                   class=" input-word hidden border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none"
                   v-model="newWord"
            >
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 add-word"
                    @click="openAddWord()"
            >+ Add word</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 save-word-input hidden mr-4"
                    @click="saveWord()"
            >Save</button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 close-word-input hidden"
                    @click="closeAddWord()"
            >Close</button>
        </div>


        <div class="flex nowrap mb-12">
            <input type="text" placeholder="Name kit"
                   class="input-kit border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none"
                   v-model="createdKitTitle"
            >

            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 "
                    @click="saveKit()"
            >Save Kit</button>
        </div>
    </section>
    </div>
</template>

<script>

export default{
    props: {
        countries: {
            type: Array
        },
        categories: {
            type: Array
        },
        userId: {
            type: Number
        }
    },
    data() {
        return {
            createdKitTitle: '',
            exseptionWords: [],
            newWord: '',
            allCountriesChecked: false,
            allCategoriesChecked: false,
            filter: null
        }
    },
    methods:{
        chooseAllItems(obj){
            switch (obj) {
                case this.countries:
                    this.allCountriesChecked ? this.allCheck(obj,false) : this.allCheck(obj,true)
                    this.allCountriesChecked = !this.allCountriesChecked
                    break
                case this.categories:
                    this.allCategoriesChecked ? this.allCheck(obj,false) : this.allCheck(obj,true)
                    this.allCategoriesChecked = !this.allCategoriesChecked
                    break
            }

        },
        openAddWord(){
            document.querySelector('.add-word').classList.add('hidden')
            document.querySelector('.input-word').classList.remove('hidden')
            document.querySelector('.close-word-input').classList.remove('hidden')
            document.querySelector('.save-word-input').classList.remove('hidden')
        },
        closeAddWord(){
            document.querySelector('.add-word').classList.remove('hidden')
            document.querySelector('.input-word').classList.add('hidden')
            document.querySelector('.close-word-input').classList.add('hidden')
            document.querySelector('.save-word-input').classList.add('hidden')
        },
        saveWord(){
            if(this.newWord != false) this.exseptionWords.push(this.newWord.trim())
            this.newWord = ''
            this.closeAddWord()
        },
        deleteWord(i){
            this.exseptionWords.splice(i,1)
        },
        saveKit(){
            let countries = []
            this.countries.forEach((item)=>{
                if(item.checked) countries.push(item.id)
            })

            let categories = []
            this.categories.forEach((item)=>{
                if(item.checked) categories.push(item.id)
            })

            if(!this.createdKitTitle) return alert('Введите название фильтра!')
            if(!countries.length && !categories.length && !this.exseptionWords.length) return alert('Введите параметр(ы) фильтра!')

            axios.post('/add-filter', {
                user_id: this.userId,
                title: this.createdKitTitle,
                countries_ids: countries.join(','),
                categories_ids: categories.join(','),
                exseption_words: this.exseptionWords.join('_|_')
            }).then(response => {
                this.filter = response.data
            });

            this.createdKitTitle = ''
            this.allCheck(this.countries,false)
            this.allCheck(this.categories,false)
            this.exseptionWords = []
            return alert('Success!')
        },
        closeKit(){
            this.$emit('disable-kit', this.filter)
        }
    },
    computed: {
        allCheck(obj, val){
            return (obj, val) => {
                obj.forEach((item) => {
                    item.checked = val
                })
            }
        }
    }
}
</script>
