<template>
<div>
    <section id="create-kit" class="w-full bg-white p-8 min-h-screen z-50 absolute top-0 left-0 right-0">
        <div class="flex justify-between items-center mb-8">
            <p class="text-2xl text-black font-bold">Create Kit</p>
            <p class="text-black text-5xl close-kit cursor-pointer hover:text-red-500" @click="$emit('disable-kit')">×</p>
            <!--            <img class="close-kit cursor-pointer" src="images/close.svg" alt="close">-->

        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Countries</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    All country
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    USA
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    United Arab Emirates
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 "
                        title="Show more">
                    ...
                </button>
            </div>
        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Categories</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    All categories
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Project Management
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    CMS Customization
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 "
                        title="Show more">
                    ...
                </button>
            </div>
        </div>

        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Filters</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    All filters
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Project Management
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    CMS Customization
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 "
                        title="Show more">
                    ...
                </button>
            </div>
        </div>

        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Technologies</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button font-bold">
                    PHP
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Laravel
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Zend
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 "
                        title="Show more">
                    ...
                </button>
            </div>
        </div>

        <div class="mb-7">
            <p class="text-lg font-bold text-black mb-3">Exception words</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer bg-gray-200 text-black rounded  px-3 font-normal mr-4 hover:bg-green-500 hover:text-white flex items-center active-button">
                    <p class="mr-2">Word1</p>
                    <p class="  py-2 pl-3 pr-1 border-l border-gray-400 exception-words text-2xl hover:text-red-500"
                       title="Delete word">
                        ×</p>

                </button>
                <button class="cursor-pointer bg-gray-200 text-black rounded  px-3 font-normal mr-4 hover:bg-green-500 hover:text-white  flex items-center active-button">
                    <p class="mr-2">Word2</p>
                    <p class="  py-2 pl-3 pr-1 border-l border-gray-400 exception-words text-2xl hover:text-red-500"
                       title="Delete word">
                        ×</p>
                </button>
                <button class="cursor-pointer bg-gray-200 text-black rounded  px-3 font-normal mr-4 hover:bg-green-500 hover:text-white  flex items-center active-button">
                    <p class="mr-2">Word3</p>
                    <p class=" py-2 pl-3 pr-1 border-l border-gray-400 exception-words text-2xl hover:text-red-500"
                       title="Delete word">
                        ×</p>
                </button>
            </div>

        </div>
        <div class="mb-12 flex nowrap">
            <input type="text" placeholder="New word"
                   class=" input-word hidden border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none">
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 add-word">+ Add word
            </button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 save-word-input hidden mr-4">
                Save
            </button>
            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-5 hover:bg-gray-700 close-word-input hidden" @click="$emit('disable-kit')">
                Close
            </button>
        </div>


        <div class="flex nowrap mb-12">
            <input type="text" placeholder="Name kit"
                   class="input-kit border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none">

            <button class="rounded rounded-full bg-gray-500 text-white py-3 px-4 hover:bg-gray-700 ">Save Kit</button>
        </div>
    </section>
    </div>
</template>

<script>

export default{
    data() {
        return {
            
        }
    },
    methods:{

    }
}
</script>
