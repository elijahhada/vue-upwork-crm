<template>
    <section
        v-if="pipedriveInfo !== null"
        id="take"
        class="fixed bg-white py-5 px-8 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-gray-300 flex flex-col justify-between"
        :class="{ hidden: !ModalJobSwitched }">
        <div class="f-full space-x-6 flex flex-nowrap justify-between items-start">
            <div class="w-full h-full flex flex-col justify-start items-start">
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Organization</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none bg-gray-200" :value="pipedriveInfo.currentUser.name" disabled="disabled">
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Title</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none" :value="title">
                </div>
<!--                <div class="w-full mb-3 relative">-->
<!--                    <p class="text-xs pl-2 text-gray-300 mb-1">Technologies</p>-->
<!--                    <select id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none">-->
<!--                        <option v-for="(label, key) in pipedriveInfo.labels" :key="key" value="" :class="'bg-' + label.color + '-500'">{{label.name}}</option>-->
<!--                    </select>-->
<!--                </div>-->
                <div class="w-full mb-3 relative">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Technologies</p>
                    <div
                        class="relative parent-tech w-full p-2 border border-gray-300 rounded-md focus:outline-none text-white flex flex-wrap justify-start items-center wrap"
                        :class="{ 'focused': isTechDropped }"
                        @click="dropdownTechs()">
                        <p
                            v-for="(item, index) in selectedTechsList"
                            :key="index"
                            class="parent-button px-1 rounded-sm cursor-pointer mr-1.5 align-middle select-none"
                            :class="'bg-' + item.color + '-500'"
                            >
                            {{ item.label }}
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
                        :class="{ 'hidden': !isTechDropped }">
                        <li v-for="(item, index) in techsList" :key="index" class="tech-button w-full hover:bg-gray-100 py-2 pl-2 mt-1" @click="addTech(index, item)">
                            <span class="px-1 rounded-sm select-none" :class="'bg-' + item.color + '-500'">{{ item.label }}</span>
                        </li>
                    </ul>
                </div>

                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Time of bid</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none bg-gray-200" value="will be set as current time" disabled="disabled">
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Time of job creation</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none bg-gray-200" :value="date_created" disabled="disabled">
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Bid profile</p>
                    <select name="" id="" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none" v-model="bidProfile">
                        <option v-for="(profile, key) in pipedriveInfo.bidProfiles" :key="key" :value="profile">{{profile.label}}</option>
                    </select>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Job posting</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none bg-gray-200" :value="url" disabled="disabled">
                </div>
            </div>
            <div class="w-full h-full flex flex-col justify-start items-start">
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Task link</p>
                    <input type="text" class="p-2 w-full border border-gray-300 rounded-md focus:outline-none" v-model="taskLink">
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Invite</p>
                    <div class="space-x-3">
                        <button class="px-3 py-2 bg-green-500 rounded-sm text-base text-black hover:bg-green-500 hover:text-white invite-none" @click="swapInvite(1)">None</button>
                        <button class="px-3 py-2 bg-gray-200 rounded-sm text-base text-white hover:bg-green-500 hover:text-white invite-yes" @click="swapInvite(2)">Yes, invite</button>
                    </div>
                </div>
                <div class="w-full mb-3">
                    <p class="text-xs pl-2 text-gray-300 mb-1">Bid</p>
                    <div class="space-x-3">
                        <textarea name="" id="" class="textarea-form p-2 w-full h-full border border-gray-300 rounded-md focus:outline-non" v-model="bidText">

                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-full mt-4 flex justify-end items-start">
            <div class="flex space-x-4">
                <button class="close-take rounded-full border border-gray-300 px-12 py-3 text-black hover:bg-green-500 hover:text-white hover:border-green-500" @click.stop="closeModalJob">
                    Cancel
                </button>
                <button class="rounded-full border border-green-500 bg-green-500 px-12 py-3 text-white hover:bg-white hover:text-black" @click="saveBid()">Save</button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    created() {
      this.loadPipedriveInfo();
      this.dropdownTechs();
    },
    data() {
        return {
            pipedriveInfo: null,
            techsList: [],
            bidProfile: null,
            invite: false,
            selectedTechsList: [],
            isTechDropped: false,
            taskLink: '',
            bidText: ''
        };
    },
    methods: {
        swapInvite(option){
            if(option === 1){
                document.querySelector('.invite-none').classList.remove('bg-gray-200');
                document.querySelector('.invite-none').classList.remove('text-black');
                document.querySelector('.invite-none').classList.add('bg-green-500');
                document.querySelector('.invite-none').classList.add('text-white');
                document.querySelector('.invite-yes').classList.remove('bg-green-500');
                document.querySelector('.invite-yes').classList.remove('text-white');
                document.querySelector('.invite-yes').classList.add('bg-gray-200');
                document.querySelector('.invite-yes').classList.add('text-black');
                this.invite = false;
            }
            if(option === 2){
                document.querySelector('.invite-none').classList.remove('bg-green-500');
                document.querySelector('.invite-none').classList.remove('text-white');
                document.querySelector('.invite-none').classList.add('bg-gray-200');
                document.querySelector('.invite-none').classList.add('text-black');
                document.querySelector('.invite-yes').classList.remove('bg-gray-200');
                document.querySelector('.invite-yes').classList.remove('text-black');
                document.querySelector('.invite-yes').classList.add('bg-green-500');
                document.querySelector('.invite-yes').classList.add('text-white');
                this.invite = true;
            }
        },
        saveBid() {
            if(this.title.length < 1 || this.selectedTechsList.length < 1 || this.bidProfile == null || this.taskLink.length < 1){
                alert('Необходимо заполнить все поля');
                return;
            }
            const data = {
                title: this.title,
                userId: this.pipedriveInfo.currentUser.id,
                label: this.selectedTechsList.map(item => item.id)[0],
                timeOfJob: this.date_created,
                bidProfile: this.bidProfile,
                jobPosting: this.url,
                taskLink: this.taskLink,
                invite: this.invite,
                jobId: this.jobId,
                owner: this.pipedriveInfo.currentUser.name,
                technologies: this.selectedTechsList.map(item => item.label)[0],
                bidMessage: this.bidText
            };
            axios.post('/pipedrive/store-deal', data).then(res => {
                console.log(res);
            }).catch(error => {
                console.log(error);
            })
            this.$store.state.ModalJobSwitched = !this.$store.state.ModalJobSwitched;
        },
        closeModalJob() {
            this.$store.state.ModalJobSwitched = !this.$store.state.ModalJobSwitched;
            this.isTechDropped = false;
            document.body.classList.remove('overflow-y-hidden');
        },
        dropdownTechs() {
            if (this.techsList.length != 0) {
                this.isTechDropped = !this.isTechDropped;
            }
        },
        removeTech(i, el) {
            this.techsList.push(el);
            this.selectedTechsList.splice(i, 1);
            this.dropdownTechs();
        },
        addTech(i, el) {
            if(this.selectedTechsList.length > 0) {
                this.techsList.push(this.selectedTechsList[0]);
                this.selectedTechsList = [];
            }
            this.selectedTechsList.push(el);
            this.techsList.splice(i, 1);
            if (this.techsList.length != 0) {
                this.isTechDropped = false;
            }
        },
        loadPipedriveInfo() {
            axios.get('/pipedrive/user-info').then(res => {
                this.pipedriveInfo = res.data;
                this.techsList = res.data.labels;
            }).catch(error => {
                console.log(error);
            })
        },
    },
    computed: {
        ModalJobSwitched() {
            return this.$store.state.ModalJobSwitched;
        },
        title() {
            return this.$store.state.DealData.title;
        },
        date_created() {
            return this.$store.state.DealData.date_created;
        },
        url() {
            return this.$store.state.DealData.url;
        },
        jobId() {
            return this.$store.state.DealData.id;
        }
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
