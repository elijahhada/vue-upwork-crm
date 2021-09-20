<template>
    <div class="w-full p-7 border border-gray-300 rounded-md my-6 relative">
        <p class="text-black text-3xl  cursor-pointer hover:text-red-500 absolute top-6 right-6" @click="deleteJob">×</p>
        <div class="w-11/12 mb-7 flex justify-between items-center">
            <p>
                <a :href="url"><span class="text-green-500 font-bold text-2xl mr-4  border-b border-gray-300">{{ title }}</span></a>
                <span class="text-black font-bold text-2xl">Score: {{ score }}%</span>
            </p>
            <p>
                <span class="text-gray-400 font-normal">Posted: {{ dateCreated }}</span>
            </p>
        </div>
        <div class="w-11/12 mb-5">
            <p class="leading-7 text-base font-normal ">
               {{ truncatedExcerpt }}
            </p>
        </div>
        <div class="w-11/12 mb-8 flex justify-start items-center">
            <p class=" bg-gray-200 text-black rounded py-3 px-2 font-normal mr-4"><span
                    class="py-2 px-3">Project Management</span></p>
            <p class="  bg-gray-200 text-black rounded py-3 px-2 font-normal mx-4"><span
                    class="py-2 px-3">Bandits</span></p>
            <p class=" bg-gray-200 text-black rounded py-3 px-2 font-normal mx-4"><span
                    class="py-2 px-3">Data Analytics</span></p>
        </div>
        <div class="w-11/12 mb-8 flex nowrap justify-start items-start text-md leading-6 ">
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Country:</span> {{ country }}</p>
                <p><span class="font-bold">Category:</span> {{ category }}</p>
                <p><span class="font-bold">Payment Verified:</span> {{ verification }}</p>
                <p><span class="font-bold">Jobs posted:</span> {{ jobsPosted }}</p>

            </div>
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Hires:</span> {{ hires }}</p>
                <p><span class="font-bold">Hire Rate:</span> {{ hireRate }}</p>
                <p><span class="font-bold">Total feedbacks:</span> {{ feedbacksCount }}</p>
                <p><span class="font-bold">Feedbacks score:</span> {{ feedback }}</p>
            </div>
            <div class="w-4/12 flex flex-col justify-start items-start">
                <p><span class="font-bold">Spent:</span> {{ totalCharge }}</p>
                <p><span class="font-bold">Hours:</span> 1031</p>
                <p><span class="font-bold">Avg Rate (based on last 6 month):</span> $22.86/h</p>
                <p><span class="font-bold">Member since:</span> April 24, 2015</p>
            </div>


        </div>
        <div class="w-11/12 mb-12">
            <p><span
                    class="text-green-500 text-lg border-b-2  border-green-500 border-dotted cursor-pointer whitespace-nowrap">Show Feedbacks (3)</span>
            </p>
        </div>
        <div class="w-full flex justify-end items-center">
            <a href="#"
               class="open-take rounded rounded-full bg-gray-300 text-black py-3 px-9 hover:bg-green-500 hover:text-white mr-7"
               @click="changeStatus(1,true)">
                Take
            </a>
            <a href="#"
               class="rounded rounded-full bg-gray-300 text-black py-3 px-9 hover:bg-green-500 hover:text-white " @click="changeStatus(2)">
                Think
            </a>

        </div>
    </div>
</template>

<script>
import AddDeal from "../Modals/AddDeal";

export default {
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
        changeStatus(status_id, el=null){
            if (el) this.$store.state.ModalJobSwitched = !this.$store.state.ModalJobSwitched
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
                    socket.emit('jobEvent', {id: this.id, action: action});
                });
        },
        deleteJob(){
            axios
                .post('/jobs/delete', {id: this.id})
                .then(response => {
                    socket.emit('jobEvent', {id: this.id, action: 'delete'})
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
