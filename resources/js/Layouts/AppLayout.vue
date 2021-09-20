<template>
    <div>

        <section class="container min-w-full mx-auto">
            <div class="container min-w-full flex justify-between">
                <div class="w-9/12 py-4 pl-6 pr-4 2xl:mr-0 mr-8 " style="padding-left: 5vw;">
                    <div class="w-full flex justify-between fixed top-0 left-0  z-30 bg-white pb-2 topmenu topmenu-width"
                        style="padding-left: 5vw;">
                        <div class="w-4/12 flex justify-start items-start ">
                            <img class="relative mt-2 fill-current text-green-500" src="images/vasterra-logo.svg"
                                alt="vasterra-logo">
                            <a href="#"
                            class="mx-4 pt-1 text-black mt-2 mb-2 border-white border-b-4 hover:border-green-500">Jobs</a>
                            <a href="#"
                            class="pt-1 mt-2  text-black border-white border-b-4 hover:border-green-500">Lidgens</a>

                        </div>
                        <div class="w-5/12 flex justify-end items-center mr-9 user-block">
                            <div class="flex justify-end items-center relative">
                                <img class="w-12" :src="$page.props.user.profile_photo_url" alt="user">
                                <p class="flex justify-center items-center cursor-pointer link-image" @click="showDropdown()">
                                    <span class="ml-2" href="#">{{ $page.props.user.name }}</span>
                                    <img class="ml-1 mt-1 cursor-pointer " src="images/arrow-down.svg"
                                        alt="arrow down">
                                </p>
                                <div class="absolute top-10 left-6 w-40 bg-white rounded-2xl shadow-2xl hidden dropdown" ref="dropdown">
                                    <ul class="p-4">
                                        <li class="my-4"><a class="border-b-4  border-white hover:border-green-500"
                                                            :href="route('profile.show')">Profile</a></li>
                                        <li><a class="border-b-4 border-white hover:border-green-500" href="#">Setting
                                            filteres</a></li>
                                        <hr class="mt-6 mb-2 min-w-full">
                                        <li><a class="border-b-4  border-white hover:border-green-500" href="#">Log out</a>
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
                <div class="w-3/12 2xl:w-2/12 calendar-block relative min-h-full z-30">
                    <SidebarCalendar></SidebarCalendar>
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
            <portal-target name="modal" multiple>
            </portal-target>

            <JobFormModal></JobFormModal>
            <GlobalCalendar></GlobalCalendar>
        <div
            class="modalShadow"
            :class="{hidden: !ModalJobSwitched}"
        ></div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import SidebarCalendar from "@/Components/SidebarCalendar";
    import GlobalCalendar from "@/Components/GlobalCalendar";
    import JobFormModal from '@/Components/Jobs/JobFormModal'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            SidebarCalendar,
            GlobalCalendar,
            JobFormModal
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
            showDropdown(){
                this.$refs.dropdown.classList.toggle('hidden')
            }
        },
        computed: {
            ModalJobSwitched(){
                return this.$store.state.ModalJobSwitched
            }
        }
    }


</script>

<style scoped>
    /*@import '../../css/style.css';*/
    @import 'https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap';
</style>
