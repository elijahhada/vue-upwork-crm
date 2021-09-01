<template>
    <app-layout>
        <div class="p-4 mx-auto">
            <div class="flex flex-col space-y-4">
                <job-card class="w-8/12 py-7 px-8 border" v-for="job in jobs.data"
                    :key="job.id"
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
        components: {
            JobCard,
            AppLayout,
        },
    }
</script>
