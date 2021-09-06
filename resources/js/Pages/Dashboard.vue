<template>
    <app-layout>
        <div class="p-4 mx-auto">
            <div class="flex flex-col space-y-4" v-if="!isReloading">
                <job-card class="w-8/12 py-7 px-8 border" v-for="job in data" :key="job.id"
                    :id="job.id"
                    :title="job.title"
                    :excerpt="job.excerpt"
                    :score="job.client_score"
                    :feedback="job.client_feedback"
                    :country="job.client_country"
                    :dateCreated="job.date_created"
                    :diffHuman="job.human_date_created"
                    :category="job.category2"
                    :subCategory="job.subcategory2"
                    :jobType="job.job_type"
                    :verification="job.client_payment_verification"
                    :budget="job.budget"
                    :url="job.url"
                    :hires="job.client_past_hires"
                    :totalCharge="job.client_total_charge"
                    :hireRate="job.client_hire_rate"
                    :feedbacksCount="job.client_reviews_count"
                    :jobsPosted="job.client_jobs_posted"
                    :jobStatus="job.status"
                ></job-card>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JobCard from "../Components/Jobs/JobCard";

    export default {
        props: {
            jobs: {
                type: Object,
                required: true,
            }
        },
        data(){
            return{
                data: [],
                isReloading: false
            }
        },
        components: {
            JobCard,
            AppLayout,
        },
        mounted() {
            console.log(this.jobs);
            this.data = this.jobs.data;
            socket.emit('test', 'FFFFFFF');
            this.jobEventListener();
        },
        methods: {
            jobEventListener(){
                socket.on('jobEventMessage', ({id, action}) => {
                    console.log('Данные получены');
                    this.isReloading = true;
                    this.data.forEach(function(item, i, arr) {
                        if(item.id == id){
                            console.log('aboba');
                            switch (action){
                                case 'delete':
                                case 'book':
                                    unset(this.data[item]);
                                    break;
                                case 'think':
                                    item.status = 2;
                            }
                        };
                    })
                    setTimeout(() => {  console.log(this.data) }, 1000);


                })
            }
        }
    }
</script>
