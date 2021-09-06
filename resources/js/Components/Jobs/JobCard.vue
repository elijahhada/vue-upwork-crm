<template>
    <div v-if="jobStatus != 1" class="flex-col rounded shadow-lg items-center bg-white" :class="{'bg-yellow': isThinking}">
        <div class="flex justify-between w-full mb-7">
            <div class="flex items-end text-xl font-bold space-x-3">
                <h2 class="text-green-upwork"><a :href="url" target="_blank">{{ title }}</a></h2>
                <p class="">Score: {{ score }}</p>
            </div>
            <div class="flex items-end space-x-3">
                <p class="opacity-50 text-sm">Posted: {{ dateCreated }}</p>
                <svg @click="deleteJob" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-current text-black w-8 h-8 cursor-pointer"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
            </div>
        </div>

        <div class="pr-12 text-sm">
            <p class="pb-5" v-if="truncated && excerpt.length > truncatedLength">{{ truncatedExcerpt }} <span @click="truncated = false" class="cursor-pointer underline">...</span></p>
            <p class="pb-5" v-else>{{ excerpt }} <span v-if="!truncated && excerpt.length > truncatedLength" @click="truncated = true" class="cursor-pointer underline">hide</span></p>
        </div>

        <div class="text-sm flex space-x-20 mb-10">
            <ul>
                <li><span class="font-semibold">Country:</span> {{ country }}</li>
                <li><span class="font-semibold">Category:</span> {{ category }}</li>
                <li><span class="font-semibold">Payment verified:</span> {{ verification }}</li>
                <li><span class="font-semibold">Jobs posted:</span> {{ jobsPosted }}</li>
            </ul>

            <ul>
                <li><span class="font-semibold">Hires:</span> {{ hires }}</li>
                <li><span class="font-semibold">Hire rate:</span> {{ hireRate }}</li>
                <li><span class="font-semibold">Total feedbacks:</span> {{ feedbacksCount }}</li>
                <li><span class="font-semibold">Feedbacks score:</span> {{ feedback }}</li>
            </ul>

            <ul>
                <li><span class="font-semibold">Spent:</span> {{ totalCharge }}</li>
                <li><span class="font-semibold">Hours:</span> {{ category }}</li>
                <li><span class="font-semibold">Avg Rate:</span> {{ verification }}</li>
                <li><span class="font-semibold">Member since:</span> {{ verification }}</li>
            </ul>
        </div>

        <div class="flex justify-end space-x-4">
            <div class="rounded-full cursor-pointer bg-gray-button py-3 px-8 hover:bg-gray-700 hover:text-white transition-all duration-300" @click="changeStatus(1)">
                Забрать
            </div>
            <div class="rounded-full cursor-pointer bg-gray-button py-3 px-8 hover:bg-gray-700 hover:text-white transition-all duration-300" @click="changeStatus(2)">
                Подумать
            </div>
        </div>
    </div>
</template>

<script>
import AddDeal from "../Modals/AddDeal";

export default {
    components: {
    },
    computed: {
        truncatedExcerpt: function() {
            return this.excerpt.substring(0, this.truncatedLength);
        }
    },
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
        hireRate: {
            required: true,
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
        }
    },
    data() {
        return {
            truncatedLength: 300,
            truncated: true,
            isThinking: false,
        }
    },
    methods: {
        showModal() {
            this.$inertia.get(this.route('pipedrive.deal.add'));
            console.log(this.$modal.show(
                AddDeal
            ))
        },
        changeStatus(status_id){
            console.log(this.id);
            axios
                .post('/jobs/change-status', {status: status_id, id: this.id})
                .then(response => {
                    var action;
                    if(status_id == 1){
                        action = 'book';
                    }else{
                        action = 'think';
                    }
                    socket.emit('jobEvent', {id: this.id, status: action});
                });
        },
        deleteJob(){
            axios
                .post('/jobs/delete', {id: this.id})
                .then(response => {
                    socket.emit('jobEvent', {id: this.id, status: 'delete'})
                });
        },
    },
    mounted() {
            if(this.jobStatus == 2){
                this.isThinking = true
            }
    }
}
</script>

<style scoped>
    .bg-yellow{
        background-color: #d9c36c !important;
    }
</style>
