<template>
    <section
        id="take"
        class="fixed bg-white py-5 px-8 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-300 flex flex-col justify-between"
        :class="{ hidden: !ModalJobSwitched }">
        <div class="f-full space-x-6 flex flex-nowrap justify-between items-start">
            <div class="w-full h-full flex flex-col justify-start items-start">
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Organization</p>
                    <select class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>Vasterra</option>
                        <option value="">Company name</option>
                        <option value="">Company name</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Title</p>
                    <select class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>Mobile Desktop responsive UI UX redes</option>
                        <option value="">Title2</option>
                        <option value="">Title3</option>
                    </select>
                </div>
                <div class="w-full mb-3 relative">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Technologies</p>
                    <div
                        class="relative parent-tech w-full p-2 border border-gray-300 rounded-md focus:outline-none text-white flex flex-wrap justify-start items-center wrap"
                        :class="{ 'focused': isTechDroped }"
                        @click="dropdownTechs()">
                        <p
                            v-for="(item, index) in selectedTechsList"
                            :key="index"
                            class="parent-button px-1 rounded-sm cursor-pointer mr-1.5 align-middle select-none"
                            :class="'bg-' + item.color + '-500'"
                            @click="removeTech(index, item)">
                            {{ item.name }} ×
                        </p>
                        <img class="open-drop-tech-menu mt-1 absolute right-3.5 top-4 select-none" src="/images/arrow-down-section.svg" alt="arrow down" />
                    </div>
                    <ul
                        class="
                            absolute
                            mt-2
                            overflow-y-auto
                            drop-menu-technologies
                            bg-white
                            w-full
                            border border-gray-300
                            rounded-md
                            focus:outline-none
                            text-white
                            flex flex-col
                            justify-start
                            items-start
                            wrap
                            space-y-2
                            shadow-lg
                        "
                        :class="{ 'hidden': !isTechDroped }">
                        <li v-for="(item, index) in techsList" :key="index" class="tech-button w-full hover:bg-gray-100 py-2 pl-2 mt-1" @click="addTech(index, item)">
                            <span class="px-1 rounded-sm select-none" :class="'bg-' + item.color + '-500'">{{ item.name }}</span>
                        </li>
                    </ul>
                </div>

                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Owner</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>Artem M (You)</option>
                        <option value="">Name2</option>
                        <option value="">Name3</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Time of bid</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>15:15</option>
                        <option value="">15:16</option>
                        <option value="">15:17</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Time after job creation</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>15:45</option>
                        <option value="">15:55</option>
                        <option value="">17:45</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Bid profile</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>Artem Mazurchak</option>
                        <option value="">Title2</option>
                        <option value="">Title3</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Job posting</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>https://docs.google.com/document/d/1xxs</option>
                        <option value="">Title2</option>
                        <option value="">Title3</option>
                    </select>
                </div>
            </div>
            <div class="w-full h-full flex flex-col justify-start items-start">
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Task link</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">
                        <option value="" selected>https://ac.vasterra.com/projects/663?modal=Taskс</option>
                        <option value="">link 2</option>
                        <option value="">link3</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Invite</p>
                    <div class="space-x-3">
                        <button class="px-3 py-2 bg-gray-200 rounded-sm text-base text-black hover:bg-green-500 hover:text-white">None</button>
                        <button class="px-3 py-2 bg-green-500 rounded-sm text-base text-white hover:bg-gray-200 hover:text-black">Yes, invite</button>
                    </div>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Bid</p>
                    <div class="space-x-3">
                        <textarea name="" id="" class="textarea-form p-2 w-full h-full border border-gray-300 rounded-md focus:outline-non">
Hi! I’d hope to create an Airbnb-like mobile app, as I built a counterpart of the Airbnb website and it was an amazing experience that I want to repeat with you.
Here you can check this project we built with my team https://www.biz-cen.ru/. This platform is specifically designed for the office segment of commercial real estate.
Visitors to the site can view a city’s commercial districts with a list of vacant premises including floor plans, and register for a preview directly online.
You can see more information here https://vasterra.com/biz-cen.
Yes, it was a web project, but of course I have strong expertise in mobile development. For example, here I worked on a Booking app for workplaces designed for Colliers International real estate company - https://play.google.com/store/apps/details?id=com.calcey.colliers&hl=en
I’d like to go to the next stage and give you an estimation of your project, are there any other details that you can share?

Best regards, Artem
                    </textarea
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-full mt-4 flex justify-end items-start">
            <div class="flex space-x-4">
                <button class="close-take rounded-full border border-gray-300 px-12 py-3 text-black hover:bg-green-500 hover:text-white hover:border-green-500" @click.stop="closeModalJob">
                    Cancel
                </button>
                <button class="rounded-full border border-green-500 bg-green-500 px-12 py-3 text-white hover:bg-white hover:text-black">Save</button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            techsList: [
                {
                    name: 'Laravel',
                    color: 'green',
                },
                {
                    name: 'Vue',
                    color: 'yellow',
                },
                {
                    name: 'Tailwind',
                    color: 'red',
                },
            ],
            selectedTechsList: [
                {
                    name: 'PHP',
                    color: 'red',
                },
                {
                    name: 'JavaScript',
                    color: 'green',
                },
                {
                    name: 'Bootstarp',
                    color: 'yellow',
                },
            ],
            isTechDroped: false,
        };
    },
    methods: {
        closeModalJob() {
            this.$store.state.ModalJobSwitched = !this.$store.state.ModalJobSwitched;
            this.isTechDroped = false;
            document.body.classList.remove('overflow-y-hidden');
        },
        dropdownTechs() {
            if (this.techsList.length != 0) {
                this.isTechDroped = !this.isTechDroped;
            }
        },
        removeTech(i, el) {
            this.techsList.push(el);
            this.selectedTechsList.splice(i, 1);
            this.dropdownTechs();
        },
        addTech(i, el) {
            this.selectedTechsList.push(el);
            this.techsList.splice(i, 1);
            if (this.techsList.length == 0) {
                this.isTechDroped = false;
            }
        },
    },
    computed: {
        ModalJobSwitched() {
            return this.$store.state.ModalJobSwitched;
        },
    },
};
</script>

<style scoped>
.parent-tech.focused {
    --tw-ring-color: #2563eb;
    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    border-color: #2563eb;
}
</style>
