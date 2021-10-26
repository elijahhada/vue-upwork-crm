<template>
    <section id="big-calendar" class="z-50" :class="{ hidden: GlobalCalendarSwitched }">
        <div class="w-full bg-gray-200 py-6 px-12 text-black z-50 min-h-screen fixed top-0 left-0 right-0">
            <div class="bg-gray-200 w-12/12 h-12/12 flex flex-col justify-start items-center px-2 relative" style="max-height: 98vh">
                <p class="text-black text-5xl cursor-pointer hover:text-red-500 absolute right-3 -top-3 cursor-pointer close-big-calendar" @click="closeGlobalCalendar()">×</p>
                <div class="flex flex-row items-center justify-center" :class="{ 'opacity-40': weekLoading }">
                    <img class="prev px-6 py-2 cursor-pointer" src="/images/calendar-arrow-left.svg" alt="prev" @click="clickWeek('prev')" />
                    <p>Неделя {{ currentWeek.title }}</p>
                    <img class="next px-6 py-2 cursor-pointer" src="/images/calendar-arrow-right.svg" alt="next" @click="clickWeek('next')" />
                </div>

                <div class="mt-8 w-full grid grid-cols-7 gap-4" :class="{ 'opacity-40': weekLoading }">
                    <div v-for="(item, index) in currentWeek.dates" :key="index" class="flex justify-center items-center">
                        {{ item.date }}
                    </div>
                </div>
                <div class="day-to-day mt-2 w-full grid grid-cols-7 gap-4 max-h-full overflow-y-auto" :class="{ 'opacity-40': weekLoading }">
                    <div v-for="(item, index) in currentWeek.dates" :key="index" :data-name="'day' + '-' + index" class="overflow-y-visible max-h-full">
                        <CalendarDay type-calendar="global" :data-day="item.dateFull"></CalendarDay>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CalendarDay from '@/Components/CalendarDay';

export default {
    components: {
        CalendarDay,
    },
    data() {
        return {
            currentWeek: '',
            weekLoading: 0,
        };
    },
    computed: {
        GlobalCalendarSwitched() {
            return this.$store.state.GlobalCalendarSwitched;
        },
    },
    watch: {
        GlobalCalendarSwitched: function () {
            if (!this.GlobalCalendarSwitched) {
                this.getData();
            }
        },
    },
    methods: {
        closeGlobalCalendar() {
            this.$store.state.GlobalCalendarSwitched = !this.$store.state.GlobalCalendarSwitched;
        },
        getData() {
            this.setCurrentWeek();
        },
        setCurrentWeek(type = 'now', current = '') {
            let data = {};
            data.type = type;
            data.current = current;
            this.currentWeek == '';
            this.weekLoading = 1;
            axios.get('/calendar/currentWeek/' + JSON.stringify(data)).then((res) => {
                this.currentWeek = res.data;
                this.$store.state.GlobalCalendarUpdate = !this.$store.state.GlobalCalendarUpdate;
                this.weekLoading = 0;
            });
        },
        clickWeek(type) {
            this.setCurrentWeek(type, this.currentWeek.dates[0].dateFull);
        },
    },
};
</script>
