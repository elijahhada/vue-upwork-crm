<template>
    <app-layout @callSearch="searchBids" @switchCalendar="switchCalendar" @switchToBids="switchToBids">
        <dash-header v-if="!isShownBids" :countries="countries" :categories="categories" :keyWords="keyWords" :userId="userId" :filters="filters" v-model="selectedKits"></dash-header>
        <div v-if="!isShownBids" class="w-full flex items-center justify-between" :class="{'job-card-stretched': !isCalendarOn}" style="max-width: 1500px!important;">
            <p class="text-2xl font-bold">Found {{ jobsData.total }} jobs</p>
            <div class="flex items-center max-w-full justify-end">
                <div class="flex justify-between search-block" ref="search_block" :class="{ 'hidden': showSearchText }" style="width: 450px;">
                    <input
                        v-model="searchInput"
                        type="text"
                        placeholder="Job id, URL,Title or key word"
                        class="w-11/12 search-input border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none placeholder-gray-300" />
                    <button class="rounded rounded-full bg-gray-300 text-black py-3 px-9 hover:bg-green-500 hover:text-white" @click="searchJobs" style="z-index: 100;!important;">Search</button>
                    <p class="ml-4 search-button text-black text-5xl cursor-pointer hover:text-red-500" @click="closeSearch()" title="Close search panel" style="z-index: 100;!important;">×</p>
                </div>
                <svg style="z-index: 45;!important;"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="cursor-pointer search"
                    title="Open search panel"
                    @click="showSearch()"
                    :class="{ 'hidden': !showSearchText }"
                    ref="search">
                    <path
                        id="search-svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M14.618 16.032C13.0243 17.309 11.0422 18.0033 9 18C6.61305 18 4.32387 17.0518 2.63604 15.364C0.948211 13.6761 0 11.3869 0 9C0 6.61305 0.948211 4.32387 2.63604 2.63604C4.32387 0.948211 6.61305 0 9 0C11.3869 0 13.6761 0.948211 15.364 2.63604C17.0518 4.32387 18 6.61305 18 9C18.0033 11.0422 17.309 13.0243 16.032 14.618L24 22.586L22.586 24L14.618 16.032ZM9 2C12.86 2 16 5.14 16 9C16 12.86 12.86 16 9 16C5.14 16 2 12.86 2 9C2 5.14 5.14 2 9 2Z"
                        fill="black" />
                </svg>
                <span v-if="showSearchText" class="text-gray-500 ml-2">Search jobs</span>
            </div>
        </div>
        <div class="flex flex-col space-y-4" v-if="!isReloading && !isShownBids">
            <job-card
                class="w-8/12 py-7 px-8 border" :class="{'job-card-stretched': !isCalendarOn}" style="max-width: 1500px!important;"
                v-for="job in data"
                :key="job.id"
                @delete="onDelete"
                @changeStatus="onChangeStatus"
                :id="job.id"
                :title="job.title"
                :excerpt="job.excerpt"
                :skills="job.tags"
                :score="job.client_score"
                :feedback="job.client_feedback"
                :feedbacks="job.feedbacks"
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
                :hourlyMin="job.hourly_min"
                :hourlyMax="job.hourly_max"
                :memberSince="job.member_since"></job-card>
        </div>
        <Toast message="Фильтры изменились, обновите страницу!" :show="showToast" @hide="showToast = false" type="warning" title="Warning" position="top-right" />
        <div v-if="showNewJobsCount && !isShownBids" class="w-full h-20 fixed bottom-0 left-0 bg-green-500 flex justify-between items-center" :class="{ 'hidden': !showNewJobsCount }">
            <div class="flex justify-around items-center">
                <p class="text-white mr-12 ml-20">Recently for your filters appeared {{ newJobsCount }} new jobs</p>
                <button class="bg-gray-300 text-black rounded rounded-full py-3 px-9 hover:bg-gray-700 hover:text-white" @click="refreshJobs">Refresh</button>
            </div>
            <p class="mr-80 text-white text-3xl cursor-pointer hover:text-red-500" @click="showNewJobsCount = false">X</p>
        </div>
        <div class="flex flex-col my-12">
            <div v-if="isShownBids" class="flex items-center">
                <button class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button" :class="{ 'bg-green-500 text-white': bidsFilter === 0 }" @click="filterBids(0)">All</button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button" :class="{ 'bg-green-500 text-white': bidsFilter === 1 }" @click="filterBids(1)">With answers</button>
                <button class="cursor-pointer hover:bg-green-500 hover:text-white bg-gray-200 text-black rounded py-3 px-4 font-normal m-2 active-button" :class="{ 'bg-green-500 text-white': bidsFilter === 2 }" @click="filterBids(2)">Without answers</button>
            </div>
            <bid-card
                class="w-8/12 py-7 px-8 border"
                v-for="job in bids"
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
                :avgRate="job.client_avg_rate"
                :bid="job.bid"
                :user="job.user"
                :memberSince="job.member_since">
            </bid-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JobCard from '../Components/Jobs/JobCard';
import BidCard from '../Components/Jobs/BidCard';
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
            bids: [],
            isReloading: false,
            selectedKits: [],
            jobsData: Object,
            bidsData: Object,
            showToast: false,
            showNewJobsCount: false,
            newJobsCount: 0,
            isShownBids: false,
            searchQuery: '',
            isCalendarOn: true,
            showSearchText: true,
            searchInput: '',
            isShowSearchJobs: false,
            isJobsOnScrollAvailable: true,
            isSearchBidsOnScrollAvailable: true,
            isSearchJobsOnScrollAvailable: true,
            isSearchJobsButtonAvailable: true,
            jobsSearchContainer: '',
            bidsSearchContainer: '',
            bidsFilter: 0,
        };
    },
    components: {
        JobCard,
        BidCard,
        AppLayout,
        DashHeader,
        Toast
    },
    mounted() {
        this.data = this.jobs.data;
        this.jobsData = this.jobs;
        this.jobListen();
        this.addLoadOnScrollEventListener();
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
        switchToBids() {
            this.searchBids('');
        },
        filterBids(filter) {
            this.bidsFilter = filter;
            this.searchBids(this.searchQuery);
        },
        searchBids(query) {
            this.searchQuery = query;
            this.isShownBids = true;
            this.loadMoreBidsOnScroll();
            axios
                .post('/jobs/with-bids', {
                    query: query,
                    filter: this.bidsFilter,
                })
                .then((res) => {
                    this.bidsData = res.data;
                    this.bids = res.data.data;
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
                    checkNewJobsCount: true,
                    createdAt: this.data[0].created_at
                })
                .then((response) => {
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
        addLoadOnScrollEventListener() {
            window.addEventListener('scroll', debounce((e) => {
                if(!this.isShownBids && !this.isShowSearchJobs) {
                    this.loadMoreOnScroll();
                }
                if(this.isShownBids) {
                    this.loadMoreBidsOnScroll();
                }
                if(this.isShowSearchJobs) {
                    this.loadMoreSearchJobsOnScroll();
                }
            }, 300))
        },
        loadMoreOnScroll() {
            let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
            if(pixelsFromBottom < 600 && this.jobsData.next_page_url !== null && this.isJobsOnScrollAvailable) {
                console.log('loadMoreOnScroll');
                this.isJobsOnScrollAvailable = false;
                let nextPageNumber = this.jobsData.next_page_url.slice(this.jobsData.next_page_url.indexOf('=') + 1)
                axios
                    .post('/jobs/filter?page=' + nextPageNumber, {
                        kits: this.selectedKits,
                    })
                    .then((response) => {
                        this.isJobsOnScrollAvailable = true;
                        console.log(response.data)
                        console.log(response.data.data)
                        this.data.push(...response.data.data.filter((j) => j.status !== 1));
                        this.jobsData = response.data;
                    }).catch(error => {
                        console.log(error);
                    });
            }
        },
        loadMoreBidsOnScroll() {
            let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
            if(pixelsFromBottom < 600 && this.bidsData.next_page_url !== null && this.isSearchBidsOnScrollAvailable) {
                console.log('loadMoreBidsOnScroll');
                this.isSearchBidsOnScrollAvailable = false;
                let nextPageNumber = this.bidsData.next_page_url.slice(this.bidsData.next_page_url.indexOf('=') + 1)
                axios
                    .post('/jobs/with-bids?page=' + nextPageNumber, {
                        query: this.searchQuery,
                        filter: this.bidsFilter,
                    })
                    .then((response) => {
                        this.isSearchBidsOnScrollAvailable = true;
                        console.log(response.data)
                        console.log(response.data.data)
                        this.bids.push(...response.data.data);
                        this.bidsData = response.data;
                    }).catch(error => {
                        console.log(error);
                    });
            }
        },
        loadMoreSearchJobsOnScroll() {
            let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
            if(pixelsFromBottom < 600 && this.jobsData.next_page_url !== null && this.isSearchJobsOnScrollAvailable) {
                console.log('loadMoreSearchJobsOnScroll');
                this.isSearchJobsOnScrollAvailable = false;
                let nextPageNumber = this.jobsData.next_page_url.slice(this.jobsData.next_page_url.indexOf('=') + 1)
                axios
                    .post('/jobs/search?page=' + nextPageNumber, {
                        query: this.jobsSearchContainer
                    })
                    .then((response) => {
                        this.isSearchJobsOnScrollAvailable = true;
                        console.log(response.data)
                        console.log(response.data.data)
                        this.data.push(...response.data.data);
                        this.jobsData = response.data;
                    }).catch(error => {
                        console.log(error);
                    });
            }
        },
        kitsListen() {
            socket.on('kits:listeners', () => {
                this.showToast = true;
                console.log('something in kits have been changed');
            });
        },
        switchCalendar(isSwitched) {
            this.isCalendarOn = isSwitched
        },
        showSearch() {
            this.showSearchText = false;
            // this.$refs.search_block.classList.remove('w-0');
            // this.$refs.search_block.classList.add('w-full');
            // this.$refs.search_block.style.cssText = 'animation: width100 .3s linear';
            // setTimeout(() => {
            //     this.$refs.search_block.classList.add('w-full');
            // }, 280);
            //
            // this.$refs.search.classList.add('hidden');
        },
        closeSearch() {
            // this.$refs.search_block.cssText = 'animation: width0 .3s linear';
            // setTimeout(() => {
            //     this.$refs.search_block.classList.remove('w-full');
            //     this.$refs.search_block.classList.add('w-0');
            //     this.$refs.search.classList.remove('hidden');
            // }, 10);
            this.showSearchText = true;
        },
        searchJobs() {
            if(this.searchInput.length < 2) {
                alert('Query string is empty, it must be at least 2 symbols, please fill it up');
                this.closeSearch();
                this.isSearchJobsOnScrollAvailable = false;
                this.isJobsOnScrollAvailable = true;
                this.isShowSearchJobs = false;
                this.refreshJobs();
                return;
            }
            this.closeSearch();
            this.jobsSearchContainer = this.searchInput; // holds value until search button is pushed
            this.isShowSearchJobs = true;
            this.isSearchJobsOnScrollAvailable = true;
            if(this.isSearchJobsButtonAvailable) {
                axios
                    .post('/jobs/search', {
                        query: this.searchInput
                    })
                    .then((res) => {
                        this.isSearchJobsButtonAvailable = true;
                        console.log(res);
                        this.data = res.data.data;
                        this.jobsData = res.data;
                    }).catch(error => {
                    console.log(error);
                });
            }
            this.isSearchJobsButtonAvailable = false;
        },
    },
    computed: {
        jobToRemove() {
            return this.$store.state.jobToRemove;
        }
    }
};
</script>
<style scoped>
@media only screen and (max-width: 1535px) {
    .job-card-stretched {
        width: 135%;
    }
}
</style>
