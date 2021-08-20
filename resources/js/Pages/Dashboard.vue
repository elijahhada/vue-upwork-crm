<template>
    <app-layout>
        <div class="container p-4 mx-auto bg-gray-600">
            <div class="flex flex-col space-y-4">
                <job-card v-for="job in jobs.data"
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
