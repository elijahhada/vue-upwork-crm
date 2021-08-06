<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="container mx-auto my-24 rounded p-4 bg-white min-h-screen flex flex-col space-y-8">
            <JobCard :title="'Job title'" :excerpt="'Job excerpt'"></JobCard>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import JobCard from "../Components/Jobs/JobCard";

    export default {
        components: {
            JobCard,
            AppLayout,
            Welcome,
        },

        updated() {
            console.log(this.$page.props.flash.message);
        },

        created() {
            console.log(this.$page.props.flash.message);
        }
    }
</script>
