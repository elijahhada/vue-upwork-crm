<template>
    <app-layout>
        <div class="container mx-auto bg-white">
            <job-card title="Title" excerpt="excerpt"></job-card>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JobCard from "../Components/Jobs/JobCard";

    export default {
        components: {
            JobCard,
            AppLayout,
            Welcome,
        },
    }
</script>
