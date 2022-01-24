<template>
    <div class="w-full p-7 border border-gray-300 rounded-md my-6 relative" :class="{ 'bg-yellow': isThinking, 'bg-light-red': isTaken }">
        <p class="text-black text-3xl cursor-pointer hover:text-red-500 absolute top-6 right-6" @click="deleteJob">×</p>
        <div class="w-11/12 mb-7 flex justify-between items-center">
            <p>
                <a :href="url"
                    ><span class="text-green-500 font-bold text-2xl mr-4 border-b border-gray-300">{{ title }}</span></a
                >
                <span class="text-black font-bold text-2xl">Score: {{ score }}%</span>
            </p>
            <p>
                <span class="text-gray-400 font-normal">Posted: {{ dateCreated }}</span>
            </p>
        </div>
        <div class="w-11/12 mb-5">
            <p class="leading-7 text-base font-normal">
                {{ truncatedExcerpt }}
            </p>
        </div>
        <div class="w-11/12 mb-8 flex justify-start items-center">
            <p v-for="cat in categories" :key="cat.id" class="bg-gray-200 text-black rounded py-3 px-2 font-normal mr-4">
                <span class="py-2 px-3">{{ cat.name }}</span>
            </p>
        </div>
        <div class="w-11/12 mb-8 flex nowrap justify-start items-start text-md leading-6">
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Country:</span> {{ country }}</p>
                <p><span class="font-bold">Category:</span> {{ category }}</p>
                <p><span class="font-bold">Payment Verified:</span> {{ verification }}</p>
                <p><span class="font-bold">Jobs posted:</span> {{ jobsPosted }}</p>
                <p v-if="jobType === 'Fixed'"><span class="font-bold">{{ jobType }}:</span> {{ budget }}$</p>
                <p v-if="jobType === 'Hourly' && hourlyMin !== '0' && hourlyMin !== null && hourlyMax !== '0' && hourlyMax !== null"><span class="font-bold">{{ jobType }}:</span> from {{ hourlyMin }}$ to {{ hourlyMax }}$</p>
                <p v-if="jobType === 'Hourly' && (hourlyMin === '0' || hourlyMin == null || hourlyMax === '0' || hourlyMax == null)"><span class="font-bold">{{ jobType }}:</span> client has not specified any price</p>
            </div>
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Hires:</span> {{ hires }}</p>
                <p><span class="font-bold">Hire Rate:</span> {{ hireRate }}</p>
                <p><span class="font-bold">Total feedbacks:</span> {{ feedbacksCount }}</p>
                <p><span class="font-bold">Feedbacks score:</span> {{ feedback }}</p>
            </div>
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Spent:</span> {{ totalCharge }}</p>
                <p><span class="font-bold">Hours:</span> {{ duration }}</p>
                <p><span class="font-bold">Avg Rate (based on last 6 month):</span> {{ avgRate ? '$' + avgRate + '/h' : '' }}</p>
                <p><span class="font-bold">Member since:</span> April 24, 2015</p>
            </div>
        </div>
        <div class="w-11/12 mb-12">
            <p><span class="text-green-500 text-lg border-b-2 border-green-500 border-dotted cursor-pointer whitespace-nowrap">Show Feedbacks (3)</span></p>
        </div>
        <div class="w-full flex justify-end items-center">
            <button :disabled="isTaken" class="open-take rounded rounded-full bg-gray-300 text-black py-3 px-9 mr-7" :class="{'hover:bg-green-500': !isTaken, 'hover:text-white': !isTaken}" @click="loadJobToStore(id)" @click.stop="changeStatus(1, true)">Take</button>
            <button :disabled="isTaken" class="rounded rounded-full bg-gray-300 text-black py-3 px-9" :class="{'hover:bg-green-500': !isTaken, 'hover:text-white': !isTaken}" @click.stop="changeStatus(isThinking ? null : 2)">
                {{ isThinking ? 'Reconsider' : 'Think' }}
            </button>
        </div>
    </div>
</template>

<script>
import AddDeal from '../Modals/AddDeal';

export default {
    props: {
        id: {
            required: true,
        },
        title: {
            required: true,
            type: String,
        },
        excerpt: {
            required: true,
            type: String,
        },
        score: {
            required: true,
            type: Number,
        },
        feedback: {
            required: true,
            type: String,
        },
        country: {
            required: true,
        },
        dateCreated: {
            required: true,
            type: String,
        },
        diffHuman: {
            required: true,
            type: String,
        },
        category: {
            required: true,
            type: String,
        },
        subCategory: {
            required: true,
            type: String,
        },
        jobType: {
            required: true,
            type: String,
        },
        verification: {
            required: true,
            type: String,
        },
        budget: {
            required: true,
            type: String,
        },
        hourlyMin: {
            required: true,
        },
        hourlyMax: {
            required: true,
        },
        url: {
            required: true,
            type: String,
        },
        hires: {
            required: true,
            type: Number,
        },
        totalCharge: {
            required: true,
            type: String,
        },
        avgRate: {
            required: false,
            type: Number,
        },
        hireRate: {
            required: true,
            type: String,
        },
        duration: {
            required: false,
            type: String,
        },
        feedbacksCount: {
            required: true,
            type: Number,
        },
        jobsPosted: {
            required: true,
            type: Number,
        },
        jobStatus: {
            required: true,
        },
    },
    data() {
        return {
            categories: this.category.split(',').map((c, i) => {
                return { id: i, name: c.trim() };
            }),
            truncatedLength: 300,
            truncated: true,
        };
    },
    computed: {
        isThinking() {
            return this.jobStatus == 2;
        },
        isTaken() {
            return this.jobStatus == 1;
        },
        truncatedExcerpt: function () {
            return this.excerpt.substring(0, this.truncatedLength);
        },
    },
    methods: {
        showModal() {
            this.$inertia.get(this.route('pipedrive.deal.add'));
            this.$modal.show(AddDeal);
        },
        loadJobToStore(jobId) {
            axios.get('/jobs/get-job/' + jobId).then(res => {
                this.$store.state.DealData = res.data;
            }).catch(error => {
                console.log(error);
            })
        },
        changeStatus(status, showModal = false) {
            if (showModal) {
                this.$store.state.ModalJobSwitched = !this.$store.state.ModalJobSwitched;
                document.body.classList.add('overflow-y-hidden');
            }
            axios.post('/jobs/change-status', { id: this.id, status }).then((res) => {
                let action = status === 1 ? 'book' : status === 2 ? 'think' : 'reconsider';
                socket.emit('job:speak', { id: this.id, action });
            });
            this.$emit('changeStatus', { id: this.id, status });
        },
        deleteJob() {
            axios.post('/jobs/delete', { id: this.id }).then((res) => {
                socket.emit('job:speak', { id: this.id, action: 'delete' });
            });
            this.$emit('delete', { id: this.id });
        },
    },
};
</script>

<style scoped>
.bg-yellow {
    background-color: #faeae3 !important;
}
.bg-light-red {
    background-color: #F84D4D !important;
}
</style>
