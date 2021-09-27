<template>
    <div class="w-3/12 2xl:w-2/12 calendar-block relative min-h-full z-30">
        <div
            class="w-3/12 2xl:w-2/12 calendar bg-gray-200 text-white fixed top-0  overflow-y-scroll  max-h-screen  "
            style="width: inherit;"
        >
            <CalendarDay
                type-calendar="local"
                :data-day="currentDateFull"
            ></CalendarDay>
        </div>
        <svg
            width="14"
            height="22"
            viewBox="0 0 14 22"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="cursor-pointer calendar-switcher fixed -ml-6 2xl:-ml-5 bottom-1/2 z-40"
            @click="switchSidebarCalendar"
            @mouseover="overGreen"
            @mouseout="overNormal"
        >
            <path
                d="M2.08834 21.0515C2.59101 21.0467 3.07408 20.8559 3.44438 20.5159L12.696 12.0406C12.9035 11.8501 13.0692 11.6185 13.1826 11.3606C13.296 11.1026 13.3545 10.8239 13.3545 10.5422C13.3545 10.2604 13.296 9.98176 13.1826 9.72382C13.0692 9.46587 12.9035 9.2343 12.696 9.04376L3.44438 0.568499C3.24897 0.380429 3.01793 0.233334 2.76483 0.13587C2.51174 0.0384068 2.24172 -0.00745915 1.97064 0.000969431C1.69956 0.00939992 1.4329 0.0719552 1.18636 0.184956C0.939809 0.297957 0.718349 0.45912 0.535004 0.65897C0.351659 0.858819 0.210132 1.09331 0.118746 1.34866C0.027361 1.60401 -0.0120372 1.87506 0.00287069 2.14586C0.0177785 2.41666 0.0866911 2.68174 0.205554 2.92552C0.324416 3.16929 0.49083 3.38684 0.695004 3.56535L8.32613 10.5422L0.711955 17.519C0.410086 17.7961 0.198954 18.158 0.106215 18.5571C0.0134763 18.9563 0.0434551 19.3741 0.192224 19.7559C0.340994 20.1377 0.601616 20.4657 0.939952 20.6969C1.27829 20.9281 1.67856 21.0517 2.08834 21.0515Z"
                id="right-arrow-55"
                fill="black"
            />
        </svg>

        <div class="fixed top-2 ml-1  w-full z-50 calendar-date">
            <button
                class="rounded rounded-full text-white text-lg py-3 px-6 bg-black bg-opacity-50"
            >
                {{ currentDate }}
            </button>
        </div>
        <div
            class="fixed bottom-2 ml-1 w-full text-black  z-50 calendar-button"
        >
            <button
                class="hover:bg-opacity-100 open-big-calendar rounded rounded-full text-white text-lg py-3 px-6 bg-gray-500 bg-opacity-80"
                @click="switchGlobal()"
            >
                All calendar
            </button>
        </div>
    </div>
</template>

<script>
import CalendarDay from "@/Components/CalendarDay";

export default {
    components: {
        CalendarDay
    },
    data() {
        return {
            switched: true,
            currentDate: "",
            currentDateFull: ""
        };
    },
    mounted() {
        this.setCurrentDate();
    },
    methods: {
        setCurrentDate() {
            this.currentDate = this.$currentDate;
            this.currentDateFull = this.$currentDateFull;
        },
        switchSidebarCalendar() {
            if (this.switched) {
                document.querySelector(".calendar-block").style.cssText =
                    "animation: width0 .3s linear;";
                setTimeout(() => {
                    document.querySelector(".calendar").classList.add("hidden");
                    document
                        .querySelector(".calendar-switcher")
                        .classList.add("right-4");
                    document.querySelector(".calendar-switcher").style.cssText =
                        "transform: rotate(180deg)";
                }, 280);
                document
                    .querySelector(".calendar-block")
                    .classList.toggle("z-40");
                document
                    .querySelector(".calendar-switcher")
                    .classList.remove("-ml-5");
                document
                    .querySelector(".calendar-date")
                    .classList.toggle("hidden");
                document
                    .querySelector(".calendar-button")
                    .classList.toggle("hidden");
                // add to top menu full width
                document.querySelector(".topmenu").classList.toggle("z-50");
                document
                    .querySelector(".topmenu")
                    .querySelector(".last-block")
                    .classList.remove("w-3/12");
                document
                    .querySelector(".topmenu")
                    .querySelector(".last-block")
                    .classList.add("w-0");
                document
                    .querySelector(".topmenu")
                    .querySelector(".user-block")
                    .classList.remove("w-5/12");
                document
                    .querySelector(".topmenu")
                    .querySelector(".user-block")
                    .classList.add("w-8/12");
                this.switched = !this.switched;
            } else {
                document.querySelector(".calendar-block").style.cssText =
                    "animation: width100 .3s linear;";
                document.querySelector(".calendar").classList.remove("hidden");
                document
                    .querySelector(".calendar-block")
                    .classList.toggle("z-40");
                setTimeout(() => {
                    document.querySelector(".calendar-switcher").style.cssText =
                        "transform: rotate(0deg)";
                }, 280);
                document
                    .querySelector(".calendar-switcher")
                    .classList.remove("right-4");
                document
                    .querySelector(".calendar-switcher")
                    .classList.add("-ml-5");
                document
                    .querySelector(".calendar-date")
                    .classList.toggle("hidden");
                document
                    .querySelector(".calendar-button")
                    .classList.toggle("hidden");
                // delete from top menu full width
                document.querySelector(".topmenu").classList.toggle("z-50");
                document
                    .querySelector(".topmenu")
                    .querySelector(".last-block")
                    .classList.add("w-3/12");
                document
                    .querySelector(".topmenu")
                    .querySelector(".last-block")
                    .classList.remove("w-0");
                document
                    .querySelector(".topmenu")
                    .querySelector(".user-block")
                    .classList.add("w-5/12");
                document
                    .querySelector(".topmenu")
                    .querySelector(".user-block")
                    .classList.remove("w-8/12");
                this.switched = !this.switched;
            }
        },
        overGreen() {
            document.querySelector("#right-arrow-55").style.fill = "#4EA52F";
        },
        overNormal() {
            document.querySelector("#right-arrow-55").style.fill = "black";
        },
        switchGlobal() {
            this.$store.state.GlobalCalendarSwitched = !this.$store.state
                .GlobalCalendarSwitched;
        }
    }
};
</script>

<style scoped></style>
