<template>
    <section
        id="big-calendar"
        class="z-50"
        :class="{hidden: GlobalCalendarSwitched}"
    >
        <div class="w-full bg-gray-200 py-6 px-12 text-black z-50 min-h-screen  fixed top-0 left-0 right-0 ">
            <div class="bg-gray-200 w-12/12 h-12/12 flex flex-col justify-start items-center px-2  relative "
                 style="max-height: 98vh;">
                <p
                    class="text-black text-5xl  cursor-pointer hover:text-red-500 absolute right-3 -top-3 cursor-pointer close-big-calendar"
                    @click="closeGlobalCalendar"
                >
                    ×</p>
                <div class="flex flex-row items-center justify-center">
                    <img class="prev mx-6 cursor-pointer" src="images/calendar-arrow-left.svg" alt="prev">
                    <p>Неделя 16.08—24.08 </p>
                    <img class="next mx-6 cursor-pointer" src="images/calendar-arrow-right.svg" alt="next">
                </div>

                <div class="mt-8 w-full grid grid-cols-7 gap-4 ">
                    <div class="flex justify-center items-center ">18.08</div>
                    <div class="flex justify-center items-center ">19.08</div>
                    <div class="flex justify-center items-center ">20.08</div>
                    <div class="flex justify-center items-center ">21.08</div>
                    <div class="flex justify-center items-center ">22.08</div>
                    <div class="flex justify-center items-center ">23.08</div>
                    <div class="flex justify-center items-center ">24.08</div>
                </div>
                <div class=" day-to-day mt-2 w-full grid grid-cols-7 gap-4  max-h-full overflow-y-auto">

                    <div data-name="day-1" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-2" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-3" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-4" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-5" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-6" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>
                    <div data-name="day-7" class="overflow-y-visible max-h-full">
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>
                        <div class="rounded-lg bg-red-700 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative hover:bg-red-700 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me">
                                Delete me
                            </div>
                        </div>
                        <div class="rounded-lg bg-green-500 text-white text-xs flex justify-between items-start my-3 pt-3 pb-6 px-3 cursor-pointer to-book  transition-all relative hover:bg-green-600 ">
                            <div> 10:00</div>
                            <div class="flex flex-col">
                                <p>Nikolay</p>
                                <p>Elena</p>
                                <p>Sveta</p>
                            </div>
                            <div>0/67</div>
                            <div class="z-40 hover:shadow-lg hidden bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer book-me">
                                Book me
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        methods: {
            closeGlobalCalendar(){
                this.$store.state.GlobalCalendarSwitched = !this.$store.state.GlobalCalendarSwitched
            }
        },
        computed: {
            GlobalCalendarSwitched(){
                return this.$store.state.GlobalCalendarSwitched
            }
        }
    }
</script>

<style scoped>

</style>
