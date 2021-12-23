<template>
    <app-layout @callSearch="searchBids">
        <dash-header v-if="this.data.length > 0" :countries="countries" :categories="categories" :keyWords="keyWords" :userId="userId" :filters="filters" v-model="selectedKits"></dash-header>
        <div v-if="this.data.length > 0" class="w-full">
            <p class="text-2xl font-bold">Found {{ jobsData.total }} jobs</p>
        </div>
        <div class="flex flex-col space-y-4" v-if="!isReloading && this.data.length > 0">
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
        <Toast message="Фильтры изменились, обновите страницу!" :show="showToast" @hide="showToast = false" type="warning" title="Warning" position="top-right" />
        <div v-if="showNewJobsCount && this.data.length > 0" class="w-full h-20 fixed bottom-0 left-0 bg-green-500 flex justify-between items-center">
            <div class="flex justify-around items-center">
                <p class="text-white mr-12 ml-20">За последние 15 минут появилось {{ newJobsCount }} jobs</p>
                <button class="bg-gray-300 text-black rounded rounded-full py-3 px-9 hover:bg-gray-700 hover:text-white" @click="refreshJobs">Обновить</button>
            </div>
            <p class="mr-80 text-white text-3xl cursor-pointer hover:text-red-500">X</p>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JobCard from '../Components/Jobs/JobCard';
import DashHeader from '../Components/DashboardHeader';
import {debounce} from "lodash/function";
import Toast from "../Components/Toast/Toast";

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
        keyWords: {
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
            showToast: false,
            showNewJobsCount: false,
            newJobsCount: 0,
        };
    },
    components: {
        JobCard,
        AppLayout,
        DashHeader,
        Toast
    },
    mounted() {
        this.data = this.jobs.data;
        this.jobsData = this.jobs;
        this.jobListen();
        this.loadMoreOnScroll();
        this.kitsListen();
        this.checkNewJobsCount();
    },
    watch: {
        jobToRemove(id) {
            const index = this.data.findIndex((p) => p.id == id);
            this.data.splice(index, 1);
        },
        selectedKits(kits) {
            this.isReloading = true;
            axios
                .post('/jobs/filter', {
                    kits: kits,
                })
                .then((response) => {
                    console.log(response);
                    this.data = response.data.data;
                    this.jobsData = response.data;
                    this.$forceUpdate();
                    this.isReloading = false;
                }).catch(error => {
                    console.log(error);
            });
        },
    },
    methods: {
        searchBids(query) {
            this.data = [];
            axios
                .post('/jobs/with-bids', {
                    query: query
                })
                .then((res) => {
                    console.log(res);
                }).catch(error => {
                console.log(error);
            });
        },
        refreshJobs() {
            axios
                .post('/jobs/filter', {
                    kits: this.selectedKits,
                })
                .then((response) => {
                    console.log(response);
                    this.data = response.data.data;
                    this.jobsData = response.data;
                    this.$forceUpdate();
                    this.isReloading = false;
                    this.showNewJobsCount = false;
                }).catch(error => {
                console.log(error);
            });
        },
        checkNewJobsCount() {
            axios
                .post('/jobs/filter', {
                    kits: this.selectedKits,
                    checkNewJobsCount: true
                })
                .then((response) => {
                    console.log(response);
                    if(response.data > 0) {
                        this.newJobsCount = response.data;
                        this.showNewJobsCount = true;
                    }
                }).catch(error => {
                    console.log(error);
                });
            setTimeout(this.checkNewJobsCount, 30000);
        },
        onDelete({ id }) {
            const index = this.data.findIndex((p) => p.id == id);
            if (index === -1) return;
            this.data.splice(index, 1);
        },
        onChangeStatus({ id, status }) {
            const index = this.data.findIndex((p) => p.id == id);
            if (index === -1) return;
            if (status == 1) {}
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
                        currentItem.status = 1;
                        this.$set(this.data, index, currentItem);
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

                if(pixelsFromBottom < 600 && this.jobsData.next_page_url !== null) {
                    axios
                        .post('/jobs/filter?page=' + this.jobsData.next_page_url.substr(this.jobsData.next_page_url.length - 1), {
                            kits: this.selectedKits,
                        })
                        .then((response) => {
                            this.data.push(...response.data.data.filter((j) => j.status !== 1));
                            this.jobsData = response.data;
                        });
                }
            },300))
        },
        kitsListen() {
            socket.on('kits:listeners', () => {
                this.showToast = true;
                console.log('something in kits have been changed');
            });
        }
    },
    computed: {
        jobToRemove() {
            return this.$store.state.jobToRemove;
        }
    }
};
</script>
