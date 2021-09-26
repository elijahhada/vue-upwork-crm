<template>
    <app-layout>
            <dash-header
                :countries="countries"
                :categories="categories"
                :userId="userId"
                :filters="filters"
            ></dash-header>
            <div class="w-full ">
                    <p class="text-2xl font-bold">Find {{data.length}} jobs</p>
            </div>
            <div class="flex flex-col space-y-4" v-if="!isReloading">
                <job-card class="w-8/12 py-7 px-8 border" v-for="job in data" :key="job.id" @delete="onDelete"
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
                    :duration="job.duration"
                    :avgRate="job.client_avg_rate"
                ></job-card>
            </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JobCard from "../Components/Jobs/JobCard";
    import DashHeader from "../Components/DashboardHeader";

    export default {
        props: {
            filters: {
                type: Array,
                required: false
            },
            jobs: {
                type: Object,
                required: true,
            },
            countries: {
                type: Array,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            userId: {
                type: Number,
                required: true
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
            DashHeader,
        },
        mounted() {
            this.data = this.jobs.data;
            socket.emit('test', 'FFFFFFF');
            this.jobEventListener();

            socket.on('job-delete:App\\Events\\JobDeleted', function (data) {
                this.data = data.result
            }.bind(this))
        },
        methods: {
            onDelete(d) {
                this.data.forEach((item, index) => {
                    if(item.id == d.id) {
                        this.data.splice(index, 1)
                    }
                })
            },
            jobEventListener(){
                socket.on('jobEventMessage', ({id, action}) => {
                    console.log('Данные получены');
                    this.isReloading = true;
                    // this.data.forEach(function(item, i, arr) {
                    //     if(item.id == id){
                    //         console.log('aboba');
                    //         switch (action){
                    //             case 'delete':
                    //             case 'book':
                    //                 unset(this.data[item]);
                    //                 break;
                    //             case 'think':
                    //                 item.status = 2;
                    //         }
                    //     };
                    // })
                    // const currentItem = this.data.filter((obj) => {
                    //     const [item] = Object.entries(obj);
                    //     return item.id === id;
                    // });
                    var index = this.data.findIndex(p => p.id == id);
                    console.log(index);
                    console.log(this.data[index])
                    console.log(action);
                    // setTimeout(() =>{
                    //     switch(action){
                    //         case 'delete':
                    //         case 'book':
                    //             this.data.splice(index, 1);
                    //             break;
                    //         case 'think':
                    //             this.data[index].status = 2;
                    //             break;
                    //     }
                    //     this.isReloading = false;
                    // }, 30);
                    switch(action){
                            case 'delete':
                            case 'book':
                                this.data.splice(index, 1);
                                break;
                            case 'think':
                                var currentItem = this.data[index];
                                currentItem.status = 2;
                                this.$set(this.data, index, currentItem);
                                break;
                        }
                    setTimeout(() =>{
                        this.isReloading = false;
                    }, 10)
                })
            }
        }
    }
</script>
