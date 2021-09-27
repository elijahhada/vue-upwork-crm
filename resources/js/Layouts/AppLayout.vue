<template>
    <div>
        <section class="container min-w-full mx-auto">
            <div class="container min-w-full flex justify-between">
                <div
                    class="w-9/12 py-4 pl-6 pr-4 2xl:mr-0 mr-8 "
                    style="padding-left: 5vw;"
                >
                    <div
                        class="w-full flex justify-between fixed top-0 left-0  z-30 bg-white pb-2 topmenu topmenu-width"
                        style="padding-left: 5vw;"
                    >
                        <div class="w-2/12 flex justify-start items-start ">
                            <img
                                class="relative mt-2 fill-current text-green-500"
                                src="images/vasterra-logo.svg"
                                alt="vasterra-logo"
                            />
                            <a
                                href="#"
                                class="mx-4 pt-1 text-black mt-2 mb-2 border-white border-b-4 hover:border-green-500"
                                >Jobs</a
                            >
                            <a
                                href="#"
                                class="pt-1 mt-2  text-black border-white border-b-4 hover:border-green-500"
                                >Lidgens</a
                            >
                        </div>
                        <div class="w-7/12 flex justify-end items-center mr-9 user-block">
                            <div class="w-full mr-4 ">
                                <div class="parent-search-block flex-nowrap w-full flex justify-end items-center" ref='parent_search_block'>
                                    <div class="w-0 overflow-hidden flex justify-between  search-block " ref="search_block">
                                        <input type="text" placeholder="Job id, URL,Title or key word"
                                               class="w-11/12 search-input  border rounded-lg border-gray-400 text-black p-2 mr-4 outline-none placeholder-gray-300">
                                        <button class=" rounded rounded-full bg-gray-300 text-black py-3 px-9 hover:bg-green-500 hover:text-white">
                                            Search
                                        </button>
                                        <p class="ml-4 search-button text-black text-5xl  cursor-pointer hover:text-red-500" @click="closeSearch()"
                                           title="Close search panel">×</p>
                                    </div>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                         class="cursor-pointer search" title="Open search panel" @click="showSearch()" ref="search">
                                        <path id="search-svg" fill-rule="evenodd" clip-rule="evenodd"
                                              d="M14.618 16.032C13.0243 17.309 11.0422 18.0033 9 18C6.61305 18 4.32387 17.0518 2.63604 15.364C0.948211 13.6761 0 11.3869 0 9C0 6.61305 0.948211 4.32387 2.63604 2.63604C4.32387 0.948211 6.61305 0 9 0C11.3869 0 13.6761 0.948211 15.364 2.63604C17.0518 4.32387 18 6.61305 18 9C18.0033 11.0422 17.309 13.0243 16.032 14.618L24 22.586L22.586 24L14.618 16.032ZM9 2C12.86 2 16 5.14 16 9C16 12.86 12.86 16 9 16C5.14 16 2 12.86 2 9C2 5.14 5.14 2 9 2Z"
                                              fill="black"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-12 flex justify-end items-center relative">
                                <img
                                    class="w-12"
                                    :src="$page.props.user.profile_photo_url"
                                    alt="user"
                                />
                                <p
                                    class="flex justify-center items-center cursor-pointer link-image"
                                    @click="showDropdown()"
                                >
                                    <span class="ml-2" href="#">{{
                                        $page.props.user.name
                                    }}</span>
                                    <img
                                        class="ml-1 mt-1 cursor-pointer "
                                        src="images/arrow-down.svg"
                                        alt="arrow down"
                                    />
                                </p>
                                <div
                                    class="absolute top-10 left-6 w-40 bg-white rounded-2xl shadow-2xl hidden dropdown"
                                    ref="dropdown"
                                >
                                    <ul class="p-4">
                                        <li class="my-4">
                                            <a
                                                class="border-b-4  border-white hover:border-green-500"
                                                :href="route('profile.show')"
                                                >Profile</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                class="border-b-4 border-white hover:border-green-500"
                                                href="#"
                                                >Setting filteres</a
                                            >
                                        </li>
                                        <hr class="mt-6 mb-2 min-w-full" />
                                        <li>
                                            <a
                                                class="border-b-4  border-white hover:border-green-500"
                                                href="#"
                                                >Log out</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="w-3/12 last-block"></div>
                    </div>
                    <main>
                        <slot></slot>
                    </main>
                </div>
                <div
                    class="w-3/12 2xl:w-2/12 calendar-block relative min-h-full z-30"
                >
                    <CalendarSidebar></CalendarSidebar>
                </div>
            </div>
        </section>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>

        <JobFormModal></JobFormModal>
        <CalendarGlobal></CalendarGlobal>
        <div class="modalShadow" :class="{ hidden: !ModalJobSwitched }"></div>
    </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import CalendarSidebar from "@/Components/CalendarSidebar";
import CalendarGlobal from "@/Components/CalendarGlobal";
import JobFormModal from "@/Components/Jobs/JobFormModal";

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        CalendarSidebar,
        CalendarGlobal,
        JobFormModal
    },

    data() {
        return {
            showingNavigationDropdown: false
        };
    },
    methods: {
        showSearch(){
            this.$refs.search_block.classList.remove('w-0')
            this.$refs.search_block.classList.add('w-full')
            this.$refs.search_block.style.cssText = 'animation: width100 .3s linear'
            setTimeout(() => {
                this.$refs.search_block.classList.add('w-full')
            }, 280)

            this.$refs.search.classList.add('hidden')
        },
        closeSearch(){
            this.$refs.search_block.cssText = 'animation: width0 .3s linear'
            setTimeout(() => {
                this.$refs.search_block.classList.remove('w-full')
                this.$refs.search_block.classList.add('w-0')
                this.$refs.search.classList.remove('hidden')
            }, 10)
        },
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
        showDropdown() {
            this.$refs.dropdown.classList.toggle("hidden");
        }
    },
    computed: {
        ModalJobSwitched() {
            return this.$store.state.ModalJobSwitched;
        }
    }
};
</script>

<style scoped>
/*@import '../../css/style.css';*/
@import "https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap";
</style>
