<template>
    <section id="manager-filters" class="w-full bg-white p-8  min-h-screen z-50 absolute top-0 left-0 right-0">
        <div class="flex justify-between items-center mb-8">
            <p class="text-2xl text-black font-bold">Artem's filters</p>
            <p class="text-black text-5xl close-manager-filters cursor-pointer hover:text-red-500" @click="$emit('disable-filter')">×</p>
            <!--            <img class="close-kit cursor-pointer" src="images/close.svg" alt="close">-->

        </div>
        <div class="mb-10">
            <p class="text-lg font-bold text-black mb-3">Filters</p>
            <div class="flex wrap justify-start items-start">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    All filters
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Project Management
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    A/B Testing
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Bandits
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Data Analytics
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Deep Learning
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Scrum
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Prototyping
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    CMS Development
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    CMS Customization
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Back-End Development
                </button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white   bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 active-button">
                    Design
                </button>

                <button class="cursor-pointer hover:bg-green-500 hover:text-white  bg-gray-200 text-black rounded py-3 px-4 font-normal mr-2 "
                        title="Show more">
                    ...
                </button>
            </div>
        </div>


    </section>
</template>

<script>

export default{
    
}
</script>
