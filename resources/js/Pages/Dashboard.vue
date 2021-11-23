<template>
    <app-layout>
        <dash-header :countries="countries" :categories="categories" :userId="userId" :filters="filters" v-model="selectedKits"></dash-header>
        <div class="w-full">
            <p class="text-2xl font-bold">Find {{ jobsData.total }} jobs</p>
        </div>
        <div class="flex flex-col space-y-4" v-if="!isReloading">
            <job-card
                class="w-8/12 py-7 px-8 border"
                v-for="job in data"
                :key="job.id"
                @delete="onDelete"
                @changeStatus="onChangeStatus"
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
                :avgRate="job.client_avg_rate"></job-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JobCard from '../Components/Jobs/JobCard';
import DashHeader from '../Components/DashboardHeader';
import {debounce} from "lodash/function";

export default {
    props: {
        filters: {
            type: Array,
            required: false,
        },
        jobs: {
            type: Object,
            required: true,
        },
        countries: {
            type: Array,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
        userId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            data: [],
            isReloading: false,
            selectedKits: [],
            jobsData: Object,
        };
    },
    components: {
        JobCard,
        AppLayout,
        DashHeader,
    },
    mounted() {
        this.data = this.jobs.data;
        this.jobsData = this.jobs;
        this.jobListen();
        this.loadMoreOnScroll();
    },
    watch: {
        selectedKits(kits) {
            this.isReloading = true;
            axios
                .post('/jobs/filter', {
                    kits: kits,
                })
                .then((response) => {
                    this.data = response.data.data.filter((j) => j.status !== 1);
                    this.$forceUpdate();
                    this.isReloading = false;
                });
        },
    },
    methods: {
        onDelete({ id }) {
            const index = this.data.findIndex((p) => p.id == id);
            if (index === -1) return;
            this.data.splice(index, 1);
        },
        onChangeStatus({ id, status }) {
            const index = this.data.findIndex((p) => p.id == id);
            if (index === -1) return;
            if (status == 1) this.data.splice(index, 1);
            else {
                const currentItem = this.data[index];
                currentItem.status = status;
                this.$set(this.data, index, currentItem);
            }
        },
        jobListen() {
            socket.on('job:listeners', ({ id, action }) => {
                const index = this.data.findIndex((p) => p.id == id);
                if (index === -1) return;
                const currentItem = this.data[index];
                switch (action) {
                    case 'delete':
                        this.data.splice(index, 1);
                        break;
                    case 'book':
                        this.data.splice(index, 1);
                        break;
                    case 'think':
                        currentItem.status = 2;
                        this.$set(this.data, index, currentItem);
                        break;
                    case 'reconsider':
                        currentItem.status = null;
                        this.$set(this.data, index, currentItem);
                        break;
                }
            });
        },
        loadMoreOnScroll() {
            window.addEventListener('scroll', debounce((e) => {
                let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;

                if(pixelsFromBottom < 600) {
                    axios
                        .post('/jobs/filter?page=' + this.jobsData.next_page_url.substr(this.jobsData.next_page_url.length - 1), {
                            kits: this.selectedKits,
                        })
                        .then((response) => {
                            console.log(response)
                            this.data.push(...response.data.data.filter((j) => j.status !== 1));
                            this.jobsData = response.data;
                        });
                }
            },300))
        }
    },
};
</script>
