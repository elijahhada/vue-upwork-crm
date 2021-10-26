<template>
    <div class="slick-slider34">
        <div v-for="(item, index) in 24" :key="index">
            <CalendarItem
                :data-index="index"
                :data-time="calendarDayTimes[index]"
                :data-users="calendarDayUsers[index] || []"
                :type-calendar="typeCalendar"
                v-model="calendarDayUsers[index]"></CalendarItem>
        </div>
    </div>
</template>

<script>
import CalendarItem from '@/Components/CalendarItem';

export default {
    props: {
        typeCalendar: String,
        dataDay: String,
    },
    components: {
        CalendarItem,
    },
    data() {
        return {
            calendarDayTimes: [],
            calendarDayUsers: [],
        };
    },
    computed: {
        GlobalCalendarSwitched() {
            return this.$store.state.GlobalCalendarSwitched;
        },
        calendarUpdate() {
            return this.$store.state.GlobalCalendarUpdate;
        },
    },
    watch: {
        GlobalCalendarSwitched() {
            this.getDayUsers();
        },
        calendarUpdate() {
            this.getDayTimes();
            this.getDayUsers();
        },
    },
    mounted() {
        this.getDayTimes();
        this.getDayUsers();
        this.calendarListen();
    },
    methods: {
        getDayTimes() {
            axios.get('/calendar/dayTimes/' + this.dataDay).then((res) => {
                this.calendarDayTimes = res.data;
            });
        },
        getDayUsers() {
            axios.get('/calendar/dayUsers/' + this.dataDay).then((res) => {
                this.calendarDayUsers = res.data;
            });
        },
        calendarListen() {
            socket.on('calendar:listeners', ({ index, time, users }) => {
                const hasItem = this.calendarDayTimes[index].dateTime === time;
                if (!hasItem) return;
                this.$set(this.calendarDayUsers, index, users);
            });
        },
    },
};
</script>
